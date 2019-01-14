<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * SellerController constructor.
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
        $sellers = $this->user->where('seller', 1);

        if ($request->q) {
            $sellers = $sellers
                ->where('email', 'LIKE', '%'. $request->q .'%')
                ->orWhere('first_name', 'LIKE', '%'. $request->q .'%')
                ->orWhere('last_name', 'LIKE', '%'. $request->q .'%')
                ;
        }

        return view('laracms.shop::seller.index', [
            'sellers' => $sellers->paginate(10)
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('laracms.shop::seller.form', compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $password = [];

        if ($request->password) {
            $password = [
                'password' => Hash::make($request->password)
            ];
        }

        if ($request->avatar) {
            $photoName = time().'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatars'), $photoName);
        }

        $data = [
            'avatar' => isset($photoName) ? asset('avatars/' . $photoName) : '',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email
        ];

        $user->update($data + $password);

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

        return redirect()->route('laracms.sellers')->with('status', 'Seller deleted!');
    }
}