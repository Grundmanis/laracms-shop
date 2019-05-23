<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\Http\Controllers\Controller;
use Grundmanis\Laracms\Modules\Shop\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * @var Review
     */
    private $review;

    /**
     * OrderController constructor.
     * @param Review $review
     */
    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $reviews = $this->review;

        if ($request->q) {
            $reviews = $reviews
                ->where('text', 'LIKE', '%' . $request->q . '%')
            ;
        }

        $reviews = $reviews->orderByDesc('id')->paginate(50);

        return view('laracms.shop::reviews.index', [
            'reviews' => $reviews
        ]);
    }

    /**
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->back()->with('status', 'Review deleted!');
    }


    /**
     * @param Review $review
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Review $review)
    {
        return view('laracms.shop::reviews.form', compact('review'));
    }

    /**
     * @param Request $request
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Review $review)
    {
        $review->update([
            'text' => $request->text
        ]);

        return redirect()->back()->with('status', trans('texts.success'));
    }
}