<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
            'name' => [ 'required', 'max:30', 'string' ],
            'value' => [ 'required', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/' ]
        ];
    }

    public function messages ()
    {
        return [
            'value.regex' => 'لطفا کد رنگ را با استفاده از منوی مشخص شده انتخاب کنید'
        ];
    }
}
