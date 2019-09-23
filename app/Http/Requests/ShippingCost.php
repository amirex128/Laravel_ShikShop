<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCost extends FormRequest
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
            'shipping_cost' => 'required|array|size:4',
            'shipping_cost.*' => 'required|array|size:2',
            'shipping_cost.*.name' => 'required|string|max:30',
            'shipping_cost.*.cost' => 'required|integer|min:0',
        ];
    }
}