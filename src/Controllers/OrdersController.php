<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\User;
use Gloudemans\Shoppingcart\Cart;
use Grundmanis\Laracms\Modules\Shop\Mails\ProductOrdered;
use Grundmanis\Laracms\Modules\Shop\Models\Order;
use Grundmanis\Laracms\Modules\Shop\Models\Shop;
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
        $this->cart = $cart;
        $this->order = $order;
        $this->shop = $shop;
        $this->user = $user;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function order()
    {
        $order = $this->order->create([
            'amount'  => $this->cart->subtotal(),
            'user_id' => Auth::user()->id
        ]);

        $items = [];
        $products = [];
        foreach ($this->cart->content() as $product) {
            $items[] = [
                'qty'        => $product->qty,
                'product_id' => $product->id,
                'price'      => $product->price,
                'order_id'   => $order->id
            ];

            $products[] = $product->id;
        }
        $order->items()->createMany($items);

        $shops = $this->shop
            ->join('products', 'shops.id', '=', 'products.shop_id')
            ->whereIn('products.id', $products)
            ->get();

        foreach ($shops as $shop) {
            $shop->user
                ->notifications()
                ->create([
                'text'            => __('texts.order_created')
            ]);
            Mail::to($shop->email)->send(new ProductOrdered());
        }

        $this->cart->destroy();

        Auth::user()
            ->notifications()
            ->create([
            'text'            => __('texts.leave_the_comment'),
        ]);

        return redirect()
            ->route('home')
            ->with('status', __('texts.orders_created'));

    }
}
