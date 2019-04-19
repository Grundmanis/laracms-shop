<?php

namespace Grundmanis\Laracms\Modules\Shop\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $password = [];
        if ($this->password) {
            $password = [
                'password' => 'string|min:6|confirmed'
            ];
        }

        $user = Auth::user();

        $data = [
            'avatar' => 'image|mimes:jpeg,gif,png',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id
        ];

        return $data + $password;
    }
}
