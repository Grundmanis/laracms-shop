<?php

namespace Grundmanis\Laracms\Modules\Shop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShopUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->seller;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uniqueName = $this->shop ? ',' . $this->shop->id : '';
        $logo = [];

        if ($this->logo) {
            $logo = ['logo' => 'image|dimensions:max_width=300,max_height=300'];
        }

        $data = [
            'name' => 'required|unique:shops,name' . $uniqueName,
            'reg_number' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
        ];

        return $data + $logo;
    }
}
