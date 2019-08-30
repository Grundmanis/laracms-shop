<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * BuyerController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $customers = $this->user->where('seller', '!=', 1);

        if ($request->q) {
            $customers = $customers
                ->where('email', 'LIKE', '%'. $request->q .'%')
                ->orWhere('first_name', 'LIKE', '%'. $request->q .'%')
                ->orWhere('last_name', 'LIKE', '%'. $request->q .'%')
            ;
        }

        return view('laracms.shop::buyer.index', [
            'customers' => $customers->orderByDesc('id')->paginate(50)
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('laracms.shop::buyer.form', compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $password = $company = [];

        if ($request->password) {
            $password = [
                'password' => Hash::make($request->password)
            ];
        }

        if ($request->avatar) {
            $photoName = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatars'), $photoName);
        }

        if ($request->company) {
            $company = [
                'company'       => $request->company,
                'reg_number'    => $request->reg_number,
                'vat_number'    => $request->vat_number,
                'legal_address' => $request->legal_address,
                'company_city'  => $request->company_city,
                'bank'          => $request->bank,
                'bank_number'   => $request->bank_number
            ];
        }

        $data = [
            'avatar'     => isset($photoName) ? asset('avatars/' . $photoName) : $user->avatar,
            'full_name'  => $request->full_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'city'       => $request->city,
            'birthday'   => $request->birthday,
            'nameday'    => $request->nameday,
            'delivery'   => $request->delivery,
            'payment'    => $request->payment
        ];

        $user->update($data + $password + $company);

        if ($request->blocked) {
            $user->blocked()->create([
                'reason' => $request->blocked_reason ?? ''
            ]);
        } else {
            $user->blocked()->delete();
        }

        return redirect()->back()->with('status', trans('texts.success'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('laracms.customers')->with('status', 'Buyer deleted!');
    }
}