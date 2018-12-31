<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use Gloudemans\Shoppingcart\Cart;
use App\Http\Controllers\Controller;
use Grundmanis\Laracms\Modules\Shop\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * CartController constructor.
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart->instance('shoppingcart');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cartData = $this->cart->content();
        $cart = [];

        foreach ($cartData as $product) {
            if (!isset($cart[$product->options->shop])) {
                $cart[$product->options->shop] = [];
                $cart[$product->options->shop]['products'] = [];
                $cart[$product->options->shop]['price'] = 0;
            }
            $cart[$product->options->shop]['products'][] = $product;
            $cart[$product->options->shop]['price'] += $product->price * $product->qty;
        }

        $user = Auth::user();

        return view('cart', [
            'user' => $user,
            'cart' => $cart
        ]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Product $product, Request $request)
    {
        $this->cart->instance('shoppingcart')->restore(Auth::user()->email);

        $cart = $this->cart->instance('shoppingcart');

        $cart->add(
            $product->id,
            $product->name,
            $request->qty ?: 1,
            $product->price,
            [
                'item' => $product,
                'shop' => $product->shop->id,
                'shopName' => $product->shop->name,
                'shopLogo' => $product->shop->logo,
                'image' => $product->image
            ]
        );

        $cart->store(Auth::user()->email);

        return redirect()->route('cart')->with('status', __('texts.product_added_to_cart'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $this->cart->instance('shoppingcart')->restore(Auth::user()->email);

        $cart = $this->cart->instance('shoppingcart');

        $cart->remove($id);

        $cart->store(Auth::user()->email);

        return redirect()->back();
    }

    /**
     * @param string $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(string $id, Request $request)
    {
        $this->cart->instance('shoppingcart')->restore(Auth::user()->email);

        $this->cart->instance('shoppingcart')->update($id, $request->qty);

        $this->cart->instance('shoppingcart')->store(Auth::user()->email);

        return redirect()->back();
    }
}
