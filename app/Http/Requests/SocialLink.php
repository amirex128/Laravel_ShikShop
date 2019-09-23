<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialLink extends FormRequest
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
            'instagram' => 'required|max:50|url',
            'telegram' => 'required|max:50|url',
            'twitter' => 'required|max:50|url',
            'facebook' => 'required|max:50|url',
        ];
    }

    public function messages ()
    {
        return [
            'instagram.required' => 'لطفا آدرس صفحه خود در اینستاگرام را وارد کنید',
            'instagram.max' => 'لینک اینستاگرام میبایست حداکثر 50 کاراکتر باشد',
            'instagram.url' => 'لطفا لینک صحیح شبکه اجتماعی اینستاگرام را وارد کنید',
       
            'telegram.required' => 'لطفا آدرس صفحه خود در تلگرام را وارد کنید',
            'telegram.max' => 'لینک تلگرام میبایست حداکثر 50 کاراکتر باشد',
            'telegram.url' => 'لطفا لینک صحیح شبکه اجتماعی تلگرام را وارد کنید',
       
            'twitter.required' => 'لطفا آدرس صفحه خود در توییتر را وارد کنید',
            'twitter.max' => 'لینک توییتر میبایست حداکثر 50 کاراکتر باشد',
            'twitter.url' => 'لطفا لینک صحیح شبکه اجتماعی توییتر را وارد کنید',
       
            'facebook.required' => 'لطفا آدرس صفحه خود در فیسبوک را وارد کنید',
            'facebook.max' => 'لینک فیسبوک میبایست حداکثر 50 کاراکتر باشد',
            'facebook.url' => 'لطفا لینک صحیح شبکه اجتماعی فیسبوک را وارد کنید',
        ];
    }
}