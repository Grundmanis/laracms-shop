<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\Http\Controllers\Controller;
use Grundmanis\Laracms\Modules\Shop\Models\Product;
use Grundmanis\Laracms\Modules\Shop\Models\Review;
use Grundmanis\Laracms\Modules\Shop\Models\Shop;
use Grundmanis\Laracms\Modules\Shop\Models\ShopFieldValue;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * @var Shop
     */
    private $shop;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var ShopFieldValue
     */
    private $fieldValue;

    /**
     * SellerController constructor.
     * @param Shop $shop
     * @param Product $product
     * @param ShopFieldValue $fieldValue
     * @internal param User $user
     * @internal param ProfileController $profileController
     */
    public function __construct(Shop $shop, Product $product, ShopFieldValue $fieldValue)
    {
        $this->shop = $shop;
        $this->product = $product;
        $this->fieldValue = $fieldValue;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $shops = $this->shop;

        if ($request->q) {
            $shops = $shops
                ->where('name', 'LIKE', '%'. $request->q .'%')
                ->orWhere('reg_number', 'LIKE', '%'. $request->q .'%')
                ->orWhere('email', 'LIKE', '%'. $request->q .'%')
                ->orWhere('second_email', 'LIKE', '%'. $request->q .'%')
                ->orWhere('phone', 'LIKE', '%'. $request->q .'%')
                ->orWhere('second_phone', 'LIKE', '%'. $request->q .'%')
                ->orWhere('address', 'LIKE', '%'. $request->q .'%')
                ->orWhere('xml', 'LIKE', '%'. $request->q .'%')
                ->orWhere('slug', 'LIKE', '%'. $request->q .'%')
                ;
        }

        return view('laracms.shop::shop.index', [
            'shops' => $shops->orderByDesc('id')->paginate(15)
        ]);
    }

    /**
     * @param Shop $shop
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Shop $shop)
    {
        $deliveries = $shop->deliveries->keyBy('delivery');
        $payments = $shop->payments->keyBy('payment');
        $worktime = $shop->worktime;
        $fieldValues = $shop->fieldValues->keyBy('laracms_shop_field');

        return view('laracms.shop::shop.form', compact('shop', 'deliveries', 'payments', 'worktime', 'fieldValues'));
    }

    /**
     * @param Request $request
     * @param Shop $shop
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Shop $shop)
    {
        // TODO delete old logo
        if ($request->logo) {
            $photoName = time().'.'.$request->logo->getClientOriginalExtension();

            /*
            talk the select file and move it public directory and make avatars
            folder if doesn't exsit then give it that unique name.
            */
            $request->logo->move(public_path('logos'), $photoName);
        }

        $shop->update([
            'logo' => isset($photoName) ? asset('logos/' . $photoName) : $shop->logo,
            'xml' => $request->xml,
            'name' => $request->name ?: $shop->name,
            //'reg_number' => $request->reg_number,
            'phone' => $request->phone,
            'second_phone' => $request->second_phone,
            'manager_phone' => $request->manager_phone,
            'email' => $request->email,
            'second_email' => $request->second_email,
            'address' => $request->address,
            'slug' => $request->slug,
            'sandbox' => $request->sandbox ? 1 : 0
        ]);

        if ($request->delivery) {
            $shop->deliveries()->delete();
            $deliveries = [];
            foreach ($request->delivery as $delivery => $deliveryData)  {
                if (($deliveryData['price'] === null || $deliveryData['price'] == 0) && !$deliveryData['enabled']) {
                    continue;
                }
                $deliveries[] = [
                    'delivery' => $delivery,
                    'price'    => $deliveryData['price'] ? (string)$deliveryData['price'] : 0,
                    'enabled'    => $deliveryData['enabled'],
                    'shop_id'  => $shop->id
                ];
            }
            $shop->deliveries()->createMany($deliveries);
        }

        if ($request->payment) {
            $shop->payments()->delete();
            $data = [];
            foreach ($request->payment as $payment => $value)  {
                $data[] = [
                    'payment' => $payment,
                    'shop_id' => $shop->id
                ];
            }
            $shop->payments()->createMany($data);
        }

        if ($request->work_time) {
            $shop->worktime()->delete();
            $shop->worktime()->create([
                'work_time' => json_encode($request->work_time)
            ]);
        }

        if ($fields = $request->fields) {
            foreach ($fields as $fieldId => $value) {
                $field = $this->fieldValue->firstOrNew([
                    'shop_id'            => $shop->id,
                    'laracms_shop_field' => $fieldId
                ]);
                $field->value = $value;
                $field->save();
            }
        }

        if ($request->blocked) {
            $shop->blocked()->create([
                'reason' => $request->blocked_reason ?? ''
            ]);
        } else {
            $shop->blocked()->delete();
        }

        return redirect()->back()->with('status', trans('texts.success'));
    }

    /**
     * @param Shop $shop
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Shop $shop)
    {
        $shop->reviews()
            ->delete();

        $shop->products()
            ->withoutGlobalScope('available')
            ->delete();

        $shop->delete();

        // delete from favorites

        // delete products from favorites

        // delete products from cart

        return redirect()->route('laracms.shops')->with('status', 'Shop deleted!');
    }

    /**
     * @param Shop $shop
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function products(Shop $shop, Request $request)
    {
        $products = $shop->products();

        if ($request->q) {
            $products = $products
                ->where('name', 'LIKE', '%'. $request->q .'%')
                ->orWhere('description', 'LIKE', '%'. $request->q .'%')
                ->orWhere('category', 'LIKE', '%'. $request->q .'%')
                ->orWhere('category_full', 'LIKE', '%'. $request->q .'%')
                ->orWhere('manufacturer', 'LIKE', '%'. $request->q .'%')
                ->orWhere('model', 'LIKE', '%'. $request->q .'%')
            ;
        }

        $products = $products->paginate(25);

        return view('laracms.shop::shop.products', compact('products'));
    }
}