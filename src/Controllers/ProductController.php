<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use Grundmanis\Laracms\Modules\MailTemplate\Models\LaracmsMailTemplate;
use Grundmanis\Laracms\Modules\Shop\Models\Product;
use Grundmanis\Laracms\Modules\Shop\Models\Review;
use Grundmanis\Laracms\Modules\Shop\Models\Shop;
use Grundmanis\Laracms\Modules\Shop\Requests\CommentAddRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @var Review
     */
    private $review;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var Shop
     */
    private $shop;

    /**
     * ProductController constructor.
     * @param Review $review
     * @param Product $product
     * @param Shop $shop
     */
    public function __construct(Review $review, Product $product, Shop $shop)
    {
        $this->review = $review;
        $this->product = $product;
        $this->shop = $shop;
    }

    /**
     * @param string $shopSlug
     * @param Product $product
     * @param string $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $shopSlug, Product $product, string $name)
    {
        if (Auth::check()) {
            $product->seen()->firstOrCreate([
                'user_id' => Auth::user()->id
            ]);
        }

        $shop = $this->shop->find($product->shop_id);
        $shopOwner = Auth::check() && Auth::user()->id == $shop->user_id;

        $reviews = $product->reviews;
        $sum = $product->reviews->sum('mark');
        $mark = count($reviews) ? round($sum / count($reviews)) : 0 ;

        $shopReviews = $product->shop->reviews;
        $sum = $product->shop->reviews->sum('mark');
        $shopMark = count($shopReviews) ? round($sum / count($shopReviews)) : 0;

        $names = explode(' ', $product->name);
        $similarProducts = $this->product
            ->where('name', 'like', '%'. $names[0] .'%')
            ->take(10)
            ->get();

        $inOtherShops = $this->product
            ->where('shop_id', '!=', $product->shop_id)
            ->where(function($query) use ($product) {
                $query
                    ->where('model', 'like', '%' . $product->model . '%')
                    ->orWhere('manufacturer', 'like', '%' . $product->manufacturer . '%');
            })
            ->take(10)
            ->get();

        $templates = LaracmsMailTemplate::get();

        $youSaw = [];
        if (Auth::check()) {
            $youSaw = Auth::user()
                ->productsSeen()
                ->with('product')
                ->take(5)
                ->get();
        }

        return view('product', compact('product', 'templates', 'youSaw', 'mark', 'shopMark', 'reviews', 'shopReviews', 'similarProducts', 'inOtherShops', 'shopOwner'));
    }

    /**
     * @param Product $product
     * @param CommentAddRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(Product $product, CommentAddRequest $request)
    {
        $review = $product->reviews()->create([
            'user_id' => Auth::user()->id,
            'text' => $request->comment,
            'mark' => $request->mark
        ]);

        if ($request->images) {
            $names = [];
            foreach ($request->images as $image) {
                $name = time() . uniqid() . '.'.$image->getClientOriginalExtension();
                $image->move(public_path('comments'), $name);
                $names[] = [
                  'url' => $name,
                  'review_id' => $review->id
                ];
            }
            $review->images()->createMany($names);
        }

        return redirect()->back()->with('status', __('texts.comment_added'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(string $shopSlug, Product $product, string $name, Request $request)
    {
        $shop = $product->shop;
        $shopOwner = $shop->user;

        return redirect()
            ->back()
            ->with('status', __('texts.mail_sent'));
    }
}
