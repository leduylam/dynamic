<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'email' => 'required|email|user_unique_email_edit:'. auth()->id(),
            'name' => 'required',
            'phone' => 'required|max:11',
            'address' => 'required|max:255',
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'email.user_unique_email_edit' => 'Email already exists',
            'sku.user_unique_sku_edit' => 'Sku already exists',
        ];
    }
}
