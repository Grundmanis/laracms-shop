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
        $this->cart = $cart;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (!\Gloudemans\Shoppingcart\Facades\Cart::content()->count()) {
            return redirect()->route('home');
        }

        $user = Auth::user();

        return view('cart', compact('user'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Product $product, Request $request)
    {
        $this->cart->add(
            $product->id,
            $product->name,
            $request->qty ?: 1,
            $product->price,
            [
                'item' => $product,
                'shop' => $product->shop->slug,
                'shopName' => $product->shop->name,
                'shopLogo' => $product->shop->logo,
                'image' => $product->image
            ]
        );

        return redirect()->route('cart')->with('status', __('texts.product_added_to_cart'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $this->cart->remove($id);

        return redirect()->back();
    }

    /**
     * @param string $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(string $id, Request $request)
    {
        $this->cart->update($id, $request->qty);

        return redirect()->back();
    }
}
