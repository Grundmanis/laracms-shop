<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\Http\Controllers\Controller;
use Grundmanis\Laracms\Modules\Shop\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryController constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('laracms.shop::category.index', [
            'categories' => $this->category->orderByDesc('id')->paginate(50)
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('laracms.shop::category.form', [
            'categories' => $this->category->all()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->category->create($request->all());

        return redirect()->route('laracms.categories')->with('status', 'Category created!');
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $categories = $this->category->all();

        return view('laracms.shop::category.form', compact('category', 'categories'));
    }

    /**
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category, Request $request)
    {
        $category->update($request->all());

        return back()->with('status', 'Category updated!');
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('laracms.categories')->with('status', 'Category deleted!');
    }
}