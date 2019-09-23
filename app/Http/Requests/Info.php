<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Info extends FormRequest
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
            'site_name' => 'required|max:30|string',
            'phone' => ['required', 'regex:/(\+98|0)?9\d{9}/'],
            'description' => 'required|max:255|string',
            'address' => 'required|max:100|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
            'watermark' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
        ];
    }
}