<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $product = $this->route('product');

        return [
            'name' => 'required',
            'cost' => 'required|numeric',
            'code' => [
                'required',
                Rule::unique('products', 'code')->ignore($product)
            ],
            
            'sale_price' => 'required|numeric',
            'can_be_partial' => 'required',
            'it_is_bought_by_box' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required'
        ];
    }
}
