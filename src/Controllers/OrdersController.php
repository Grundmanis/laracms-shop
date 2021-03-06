<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Gloudemans\Shoppingcart\Cart;
use Grundmanis\Laracms\Modules\Shop\Models\Order;
use Grundmanis\Laracms\Modules\Shop\Models\Product;
use Grundmanis\Laracms\Modules\Shop\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Order
     */
    private $order;

    /**
     * @var Shop
     */
    private $shop;

    /**
     * @var User
     */
    private $user;

    /**
     * OrdersController constructor.
     * @param Cart $cart
     * @param Order $order
     * @param Shop $shop
     * @param User $user
     */
    public function __construct(Cart $cart, Order $order, Shop $shop, User $user)
    {
        $this->cart = $cart->instance('shoppingcart');
        $this->order = $order;
        $this->shop = $shop;
        $this->user = $user;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function order(Request $request)
    {
        // collect cart info per shop
        $infoPerShop = [];
        $user = Auth::user();
        $deleted = false;

        foreach ($request->except('_token') as $key => $shops) {
            foreach ($shops as $shop => $keyValue) {
                $infoPerShop[$shop][$key] = $keyValue;
            }
        }

        // get shops with deliveries
        $shops = Shop::whereIn('id', array_keys($infoPerShop))
            ->with('deliveries')
            ->get();

        // append the delivery price to $infoPerShop
        foreach ($shops as $shop) {
            $deliveryName = $infoPerShop[$shop->id]['delivery'];
            if ($deliveryName) {
                $delivery = $shop->deliveries->filter(function ($value, $key) use ($deliveryName) {
                    return $value->delivery == $deliveryName;
                })->first();

                if ($delivery) {
                    $infoPerShop[$shop->id]['delivery_price'] = $delivery->price;
                }
            }
        }

        $items = [];

        // collect the ordered products
        foreach ($this->cart->content() as $product) {

            $dbProduct = Product::find($product->id);

            if (!$dbProduct || empty($infoPerShop[$product->options->shop])) {
                $deleted = true;
                continue;
            }

            // calculate the full amount per shop
            if (!isset($infoPerShop[$product->options->shop]['amount'])) {
                $infoPerShop[$product->options->shop]['amount'] = 0;
            }

            $infoPerShop[$product->options->shop]['amount'] += $product->price * $product->qty;

            if (!isset($items[$product->options->shop])) {
                $items[$product->options->shop] = [];
            }
            // build the ordered items
            $items[$product->options->shop][] = [
                'qty'        => $product->qty,
                'product_id' => $product->id,
                'price'      => $product->price,
                'info'       => isset($infoPerShop[$product->options->shop]) ? json_encode($infoPerShop[$product->options->shop]) : ''
            ];
        }

        // create the order
        foreach ($infoPerShop as $shopId => $shopOrder) {
            if (empty($shopOrder['amount'])) {
                continue;
            }
            $order = $this->order->create([
                'user_id'        => $user->id,
                'amount'         => $shopOrder['amount'],
                'delivery'       => $shopOrder['delivery'],
                'delivery_price' => $shopOrder['delivery_price'] ?? 0,
                'shop_id'        => $shopId
            ]);
            $order->items()->createMany($items[$shopId]);
        }

        if (!empty($items)) {
            // create the notification for the shop
            foreach ($shops as $shop) {
                $shop->user->notifications()->create([
                    'text' => __('texts.want_to_buy', [
                        'shop' => $shop->name,
                        'url' => route('profile.shop.orders', $shop->id)
                    ])
                ]);
            }

            // clean the cart
            $this->cart->destroy();

            $identifier = Auth::user()->email . '_shoppingcart';

            DB::table(config('cart.database.table'))->where([
                ['identifier', $identifier],
                ['instance', 'shoppingcart']
            ])->delete();

            // create the notification for the user
            $user
                ->notifications()
                ->create([
                    'text' => __('texts.leave_the_comment', ['route' => route('profile.orders')])
                ]);

            $status = $deleted ? __('texts.orders_created_but_deleted') : __('texts.orders_created');

            return redirect()
                ->route('home')
                ->with('status', $status);
        }

        return redirect()
            ->route('home')
            ->with('status', __('texts.products_were_deleted'));


    }
}
