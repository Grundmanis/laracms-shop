<?php

namespace Grundmanis\Laracms\Modules\Shop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShopCreateRequest extends FormRequest
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
        $uniqueName = $this->shop ? ',' . $this->shop->id : '';
        $rules = [
            'name' => 'required|unique:shops,name' . $uniqueName,
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'logo' => 'required|image',
            'delivery' => 'required|array',
            'delivery.*.price' => 'numeric|nullable',
            'payment' => 'array',
            ];

        if ($this->xml) {
            $rules['xml'] = 'unique:shops';
        }

        return $rules;
    }
}
