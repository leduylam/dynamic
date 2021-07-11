<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
        return [
            'name' => ['required','max:255'],
            'email' => ['required','email','max:255','user_unique_email'],
            'sku' => ['required', 'max:255', 'user_unique_sku'],
            'phone' => ['required','min:9','max:11'],
            'address' => ['string','max:255'],
            'password' => ['required','min:6','max:12','confirmed'],
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'email.user_unique_email' => 'Email already exists',
            'sku.user_unique_sku' => 'Sku already exists',
        ];
    }
}
