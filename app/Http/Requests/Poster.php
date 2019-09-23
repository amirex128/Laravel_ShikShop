<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Poster extends FormRequest
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
            'posters' => 'required|array|size:3',
            'posters.*' => 'required|array|min:4',
            'posters.*.photo' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
            'posters.*.title' => 'required|max:30|string',
            'posters.*.description' => 'required|max:50|string',
            'posters.*.link' => 'required|max:100|url',
            'posters.*.button' => 'required|max:30|string',
        ];
    }

    public function messages ()
    {
        return [
            'posters.required' => 'متاسفانه هیچ پوستری ارسال نشده است ، لطفا دوباره تلاش کنید .',
            'posters.array' => 'متاسفانه در اطلاعات ارسالی مشکلاتی وجود دارد ، لطفا دوباره تلاش کنید',
            'posters.size' => 'تعداد پوستر های ارسالی میباست 3 عدد باشد',
            
            'posters.*.required' => 'متاسفانه هیچ پوستری ارسال نشده است',
            'posters.*.array' => 'متاسفانه در اطلاعات ارسالی مشکلات وجود دارد ، لطفا دوباره تلاش کنید',
            'posters.*.min' => 'متاسفانه در اطلاعات ارسالی مشکلات وجود دارد ، لطفا دوباره تلاش کنید',
            
            'posters.*.photo.image' => 'فایل انتخابی برای پوسترها میبایست از نوع عکس باشد',
            'posters.*.photo.mimes' => 'فرمت های مجاز برای تصویر پوستر ها فقط jpg , jpeg و png میباشد',
            'posters.*.photo.max' => 'حجم ارسالی برای عکس هر پوستر حداکثر ۵۱۲ کیلوبایت میباشد',
            
            'posters.*.title.required' => 'وارد کردن عنوان تمامی پوستر ها اجباری است',
            'posters.*.title.max' => 'عنوان هر پوستر میبایست حداکثر ۳۰ کاراکتر باشد',
            'posters.*.title.string' => 'استفاده از کاراکتر ها در عنوان پوستر مجاز نیست',
            
            'posters.*.description.required' => 'وارد کردن توضیحات تمامی پوستر ها اجباری است',
            'posters.*.description.max' => 'توضیحات هر پوستر میبایست حداکثر ۵۰ کاراکتر باشد',
            'posters.*.description.string' => 'استفاده از کاراکتر ها در توضیحات پوستر مجاز نیست',
            
            'posters.*.link.required' => 'وارد کردن لینک تمامی پوستر ها اجباری است',
            'posters.*.link.max' => 'لینک هر پوستر میبایست حداکثر ۱۰۰ کاراکتر باشد',
            'posters.*.link.url' => 'لینک پوستر را باید به صورت صحیح وارد کنید',
            
            'posters.*.button.required' => 'وارد کردن عنوان دکمه تمامی پوستر ها اجباری است',
            'posters.*.button.max' => 'عنوان دکمه هر پوستر میبایست حداکثر ۳۰ کاراکتر باشد',
            'posters.*.button.string' => 'استفاده از کاراکتر ها در عنوان دکمه پوستر مجاز نیست',
        ];
    }
}
