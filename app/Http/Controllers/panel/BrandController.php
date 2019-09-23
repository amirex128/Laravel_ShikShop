<?php

namespace App\Http\Controllers\panel;

use App\Models\Brand;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the Brands.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.brand', [
            'brands' => Brand::latest()->get(),
            'page_name' => 'brand',
            'page_title' => 'ثبت برند',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Brand.
     *
     * @return \Illuminate\Http\Response
     *
     * public function create()
     * {
     *   //
     * }
     */ 

    /**
     * Store a newly created brand in storage.
     *
     * @param  \App\Http\Requests\BrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        Brand::create( $request->all() );
        return redirect()->back()->with('message', "برند {$request->title} با موفقیت ثبت شد");
    }

    /**
     * Display the specified brand.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     * 
     * public function show(Brand $brand)
     * {
     *   //
     * }
     */

    /**
     * Show the form for editing the specified brand.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('panel.brand', [
            'brands' => Brand::latest()->get(),
            'brand' => $brand,
            'page_name' => 'brand',
            'page_title' => "ویرایش برند {$brand->title}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified brand in storage.
     *
     * @param  \App\Http\Requests\BrandRequest  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->update( $request->all() );
        return redirect()->back()->with('message', "برند {$brand->title} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified brand from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect( route('brand.index') )->with('message', "برند {$brand->title} با موفقیت حذف شد");
    }
}
