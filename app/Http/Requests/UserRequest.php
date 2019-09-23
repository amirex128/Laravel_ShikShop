<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required|min:3|max:20|regex:/^[پچجحخهعغآفقثصضشسیبلاتنمکگوئدذرزطظژ\s]+$/u',
            'last_name' => 'required|min:3|max:30|regex:/^[پچجحخهعغآفقثصضشسیبلاتنمکگوئدذرزطظژ\s]+$/u',
            'phone' => [ 'required', 'regex:/^(\+98|0)?9\d{9}$/' ],
            'email' => 'required|email|max:100',
            'mac_address' => [ 'required', 'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/i' ],
        ];
    }

    public function messages ()
    {
        return [
            'first_name.required' => 'لطفا نام خود را وارد کنید',
            'first_name.min' => 'نام ، میبایست حداعقل 3 کاراکتر باشد !',
            'first_name.max' => 'نام ، میبایست حداکثر 20 کاراکتر باشد !',
            'first_name.regex' => 'لطفا نام خود را به درستی وارد کنید ، نام فقط شامل حروف فارسی است !',
            'last_name.required' => 'لطفا نام خانوادگی خود را وارد کنید',
            'last_name.min' => 'نام خانوادگی ، میبایست حداعقل 3 کاراکتر باشد !',
            'last_name.max' => 'نام خانوادگی ، میبایست حداکثر 30 کاراکتر باشد !',
            'last_name.regex' => 'لطفا نام خانوادگی خود را به درستی وارد کنید ، نام خانوادگی فقط شامل حروف فارسی است !',
            'phone.required' => 'لطفا شماره تلفن خود را وارد کنید',
            'phone.regex' => 'لطفا شماره تلفن خود را به درستی وارد کنید ، شماره تلفن فقط شامل عدد است و با پیش شماره 0 یا +98 شروع میشود !',
            'email.required' => 'لطفا آدرس ایمیل خود را وارد کنید',
            'email.email' => 'لطفا آدرس ایمیل خود را به درستی وارد کنید ، فرمت صحیح آدرس ایمیل به این صورت است : example@example.com !',
            'email.max' => 'آدرس ایمیل ، میبایست حداکثر 100 کاراکتر باشد !',
        ];
    }
}
