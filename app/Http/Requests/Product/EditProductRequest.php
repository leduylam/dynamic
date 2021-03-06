<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'sku' => 'required|max:11|custom_unique_sku_edit:'.$this->id,
            'price' => 'required|max:11',
            'quantity.*' => 'required|integer',
            'price_detail.*' => 'required|integer',
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'sku.custom_unique_sku_edit' => 'Sku already exists.',
        ];
    }
}
