<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\Console\Commands\UploadImage;
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
     * @param int $productId
     * @param string $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $shopSlug, int $productId, string $name)
    {
        $product = Product::withoutGlobalScope('available')->with(['shop.reviews'])->find($productId);

//        if ($product->shop->sandbox || $product->shop->blocked->count())
//        {
//            abort(404);
//        }

        if (!$product) {
            abort(404);
        }

        if (Auth::check()) {
            $product->seen()->firstOrCreate([
                'user_id' => Auth::user()->id
            ]);
        }

        $shop = $product->shop;
        $shopOwner = Auth::check() && Auth::user()->id == $shop->user_id;

        $reviews = $product
            ->reviews()
            ->with('user')
            ->orderByDesc('id')
            ->get();

        $markedReviews = $product
            ->reviews()
            ->where('mark', '!=', 0)
            ->with('user')
            ->orderByDesc('id')
            ->get();

        $sum = $product->reviews->sum('mark');
        $mark = count($markedReviews) ? round($sum / count($markedReviews)) : 0 ;

        $shopReviews = $product->shop->reviews;

        $similarProducts = $this->product
            ->where('name', 'like', '%'. $product->name .'%')
            ->where('id', '!=', $product->id)
            ->take(5)
            ->with(['shop.reviews', 'reviews'])
            ->get();

        $inOtherShops = $this->product
            ->where('shop_id', '!=', $product->shop_id)
            ->where(function($query) use ($product) {
                $query
                    ->where('name', 'like', '%' . $product->name . '%');
//                    ->where('model', 'like', '%' . $product->model . '%')
//                    ->orWhere('manufacturer', 'like', '%' . $product->manufacturer . '%');
            })
            ->take(5)
            ->with(['shop.reviews', 'reviews'])
            ->get();

        $templates = LaracmsMailTemplate::get();

        $youSaw = [];

        if (Auth::check()) {
            $youSaw = Auth::user()
                ->productsSeen()
                ->with('product.shop.reviews', 'product.reviews')
                ->take(5)
                ->orderByDesc('id')
                ->get();

            Auth::user()
                ->productsSeen()
                ->firstOrCreate([
                    'product_id' => $product->id
                ]);
        }

        return view('product', compact('product', 'templates', 'youSaw', 'mark', 'reviews', 'shopReviews', 'similarProducts', 'inOtherShops', 'shopOwner'));
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
                $photoPath = (new UploadImage('images/review', $image))->uploadByRequestFile();
                $names[] = [
                    'url' => $photoPath['originalImagePath'],
                    'thumbnail' => $photoPath['thumbnailPath'],
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
        $message = $request->message;

        $shop->conversations()->create([
            'shop_id' => $shop->id,
            'sender_id' => Auth::user()->id,
            'message' => $message
        ]);

        return redirect()
            ->back()
            ->with('status', __('texts.mail_sent'));
    }
}
