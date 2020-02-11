<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitRequest extends FormRequest
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
        $unit = $this->route('unit');

        return [
            'name' => [
                Rule::unique('units', 'name')->ignore($unit)
            ],
            'ml' => 'required|numeric',
            'sale_piece' => 'required',
        ];
    }
}
