<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class EditOrderRequest extends FormRequest
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
            'customer_sku' => ['required', 'string', 'check_sku_user'],
            'sku' => ['required', 'unique:orders,sku,'. $this->id],
            'product_sku.*' => ['required', 'check_sku_product'],
            'product_name.*' => ['required'],
            'quantity.*' => ['required', 'integer'],
            'price.*' => ['required'],
            'discount.*' => ['nullable', 'integer'],
            'total_product_detail.*' => ['required', 'integer'],
            'customer' => ['required', 'string', 'max:255'],
            'address' => ['required' , 'string', 'max:255'],
            'shipping_start_date' => ['nullable']
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'product_sku.*.check_sku_product' => 'Product empty',
            'customer_sku.check_sku_user' => 'User empty',
        ];
    }
}
