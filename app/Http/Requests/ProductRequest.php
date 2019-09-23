<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules ()
    {
        $rules = [
            'name'          => [ 'required', 'max:50' ],
            'categories'    => [ 'nullable', 'array' ],
            'categories.*'  => [ 'nullable', 'integer', 'exists:categories,id' ],
            'link'          => [ 'required', 'url', 'max:255' ],
            'brand_id'      => [ 'nullable', 'integer', 'exists:brands,id' ],
            'size_id'       => [ 'nullable', 'integer', 'exists:sizes,id' ],
            'design_id'     => [ 'nullable', 'integer', 'exists:designs,id' ],
            'color_id'      => [ 'nullable', 'integer', 'exists:colors,id' ],
            'price'         => [ 'required', 'digits_between:1,10', 'min:0', 'integer' ],
            'offer'         => [ 'nullable', 'digits_between:1,10', 'min:0', 'integer' ],
            'status'        => [ 'required', 'boolean' ],
            'special'       => [ 'required', 'boolean' ],
            'description'   => [ 'nullable' ],
            'images'        => [ 'nullable', 'array' ],
            'deleted_images'=> [ 'nullable', 'json' ],
            "specs"         => [ 'nullable', 'array' ],
            "specs.*"       => [ 'nullable', 'array' ],
            "specs.*.id"    => [ 'nullable', 'integer', 'exists:specifications,id' ],
            "specs.*.key"   => [ 'nullable', 'string', 'max:190' ],
            "specs.*.value" => [ 'nullable', 'string' ],
        ];

        if ( request()->method() == 'POST' )
        {
            $rules['images'] = [ 'required', 'array', 'min:1' ];
        }
        return $rules;
    }

    public function messages ()
    {
        return [
            'images.*.dimensions'   => 'تمامی عکس ها باید به صورت مربع (نسبت 1 به 1) باشند .',
        ];
    }

    public function attributes()
    {
        return [
            'name'          => 'نام محصول',
            'code'          => 'کد محصول',
            'description'   => 'توضیح محصول',
            'parent'        => 'گروه',
            'aparat_video'  => 'ویديوی آپارات',
            'brand'         => 'برند',
            'label'         => 'لیبل',
            'status'        => 'وضعیت',
            'keywords'      => 'کلمات کلیدی',
            'note'          => 'یادداشت',
            'images'        => 'عکس های محصول',
            'images.*'      => 'عکس های محصول',
            'deleted_images'=> 'عکس های پاک شده',
            'advantages'    => 'مزایای محصول',
            'disadvantages' => 'معایب محصول',
            'price'         => 'قیمت محصول',
            'offer'         => 'تخفیف',
        ];
    }
}
