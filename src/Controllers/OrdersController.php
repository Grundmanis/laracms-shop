<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\User;
use Gloudemans\Shoppingcart\Cart;
use Grundmanis\Laracms\Modules\Shop\Mails\ProductOrdered;
use Grundmanis\Laracms\Modules\Shop\Models\Conversation;
use Grundmanis\Laracms\Modules\Shop\Models\Order;
use Grundmanis\Laracms\Modules\Shop\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

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
        $shops = [];
        foreach ($request->except('_token') as $key => $shopData) {
            foreach ($shopData as $shop => $keyValue) {
                $shops[$shop][$key] = $keyValue;
            }
        }

        $order = $this->order->create([
            'amount'  => $this->cart->subtotal(),
            'user_id' => Auth::user()->id
        ]);

        $user = Auth::user();
        $items = [];
        $products = [];
        $shopProducts = [];
        foreach ($this->cart->content() as $product) {
            $items[] = [
                'qty'        => $product->qty,
                'product_id' => $product->id,
                'price'      => $product->price,
                'order_id'   => $order->id,
                'info' => isset($shops[$product->options->shop]) ? json_encode($shops[$product->options->shop]) : ''
            ];
            $products[] = $product->id;
            if (!isset($shopProducts[$product->options->item->shop_id])) {
                $shopProducts[$product->options->item->shop_id] = [];
            }
            $shopProducts[$product->options->item->shop_id][] = $product->options->item;
        }
        $order->items()->createMany($items);

        $shops = $this->shop
            ->join('products', 'shops.id', '=', 'products.shop_id')
            ->whereIn('products.id', $products)
            ->select('shops.*')
            ->get();

        foreach ($shopProducts as $shopId => $products) {
            $shop = $shops->find($shopId);
            if ($shop) {
                foreach ($products as $product) {
                    $shop->conversations()->create([
                        'shop_id' => $shop->id,
                        'sender_id' => $user->id,
                        'message' => __('texts.want_to_buy', ['product' => $product->getLink()])
                    ]);
                }
            }
        }

        $this->cart->destroy();

        $user
            ->notifications()
            ->create([
            'text' => __('texts.leave_the_comment', ['route' => route('profile.orders')])
        ]);

        return redirect()
            ->route('home')
            ->with('status', __('texts.orders_created'));

    }
}
