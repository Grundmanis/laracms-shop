<?php

namespace Grundmanis\Laracms\Modules\Shop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ShopUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = [
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
        ];

        if ($this->xml) {
            $data['xml'] = Rule::unique('shops')->ignore($this->shop->id, 'id');
        }

        return $data;
    }
}
