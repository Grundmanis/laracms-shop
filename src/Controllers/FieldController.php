<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\Http\Controllers\Controller;
use Grundmanis\Laracms\Modules\Shop\Models\ShopField;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * @var ShopField
     */
    private $field;

    /**
     * ShopFieldController constructor.
     * @param ShopField $field
     */
    public function __construct(ShopField $field)
    {
        $this->field = $field;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('laracms.shop::shop_field.index', [
            'fields' => $this->field->paginate(10)
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('laracms.shop::shop_field.form');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->field->create($request->all());

        return redirect()->route('laracms.fields')->with('status', 'ShopField created!');
    }

    /**
     * @param ShopField $field
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ShopField $field)
    {
        $fields = $this->field->all();

        return view('laracms.shop::shop_field.form', compact('field', 'fields'));
    }

    /**
     * @param ShopField $field
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ShopField $field, Request $request)
    {
        $field->update($request->all());

        return back()->with('status', 'ShopField updated!');
    }

    /**
     * @param ShopField $field
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ShopField $field)
    {
        $field->delete();
        return redirect()->route('laracms.fields')->with('status', 'ShopField deleted!');
    }
}