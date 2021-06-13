<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditAdminRequest extends FormRequest
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
            'email' => ['required','email','max:255','custom_unique_email_edit:'. $this->id],
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
            'email.custom_unique_email_edit' => 'Email already exists',
        ];
    }
}
