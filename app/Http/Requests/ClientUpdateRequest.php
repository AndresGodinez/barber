<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
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
        $client = $this->route('client');

        return [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('clients', 'email')->ignore($client)
            ],
            'telephone' => [
                'required',
                Rule::unique('clients', 'telephone')->ignore($client)
            ]
        ];
    }
}
