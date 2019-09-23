<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Slider extends FormRequest
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
            'slides' => 'required|array|size:3',
            'slides.*' => 'required|array|min:4',
            'slides.*.photo' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
            'slides.*.title' => 'required|max:30|string',
            'slides.*.description' => 'required|max:50|string',
            'slides.*.link' => 'required|max:100|url',
            'slides.*.button' => 'required|max:30|string',
        ];
    }

    public function messages ()
    {
        return [
            'slides.required' => 'متاسفانه هیچ اسلایدی ارسال نشده است ، لطفا دوباره تلاش کنید .',
            'slides.array' => 'متاسفانه در اطلاعات ارسالی مشکلاتی وجود دارد ، لطفا دوباره تلاش کنید',
            'slides.size' => 'تعداد اسلاید های ارسالی میباست 3 عدد باشد',
            
            'slides.*.required' => 'متاسفانه هیچ اسلایدی ارسال نشده است',
            'slides.*.array' => 'متاسفانه در اطلاعات ارسالی مشکلات وجود دارد ، لطفا دوباره تلاش کنید',
            'slides.*.min' => 'متاسفانه در اطلاعات ارسالی مشکلات وجود دارد ، لطفا دوباره تلاش کنید',
            
            'slides.*.photo.image' => 'فایل انتخابی برای اسلایدها میبایست از نوع عکس باشد',
            'slides.*.photo.mimes' => 'فرمت های مجاز برای تصویر اسلاید ها فقط jpg , jpeg و png میباشد',
            'slides.*.photo.max' => 'حجم ارسالی برای عکس هر اسلاید حداکثر ۵۱۲ کیلوبایت میباشد',
            
            'slides.*.title.required' => 'وارد کردن عنوان تمامی اسلاید ها اجباری است',
            'slides.*.title.max' => 'عنوان هر اسلاید میبایست حداکثر ۳۰ کاراکتر باشد',
            'slides.*.title.string' => 'استفاده از کاراکتر ها در عنوان اسلاید مجاز نیست',
            
            'slides.*.description.required' => 'وارد کردن توضیحات تمامی اسلاید ها اجباری است',
            'slides.*.description.max' => 'توضیحات هر اسلاید میبایست حداکثر ۵۰ کاراکتر باشد',
            'slides.*.description.string' => 'استفاده از کاراکتر ها در توضیحات اسلاید مجاز نیست',
            
            'slides.*.link.required' => 'وارد کردن لینک تمامی اسلاید ها اجباری است',
            'slides.*.link.max' => 'لینک هر اسلاید میبایست حداکثر ۱۰۰ کاراکتر باشد',
            'slides.*.link.url' => 'لینک اسلاید را باید به صورت صحیح وارد کنید',
            
            'slides.*.button.required' => 'وارد کردن عنوان دکمه تمامی اسلاید ها اجباری است',
            'slides.*.button.max' => 'عنوان دکمه هر اسلاید میبایست حداکثر ۳۰ کاراکتر باشد',
            'slides.*.button.string' => 'استفاده از کاراکتر ها در عنوان دکمه اسلاید مجاز نیست',
        ];
    }
}
