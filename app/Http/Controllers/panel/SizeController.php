<?php

namespace App\Http\Controllers\panel;

use App\Models\Size;
use App\Http\Requests\SizeRequest;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    /**
     * Display a listing of the Sizes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Size::with('size_group')->latest()->get()[0]->size_group->size;
        
        return view('panel.size', [
            'sizes' => Size::with('size_group')->latest()->get(),
            'page_name' => 'size',
            'page_title' => 'ثبت سایز',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Size.
     *
     * @return \Illuminate\Http\Response
     *
     * public function create()
     * {
     *   //
     * }
     */ 

    /**
     * Store a newly created Size in storage.
     *
     * @param  \App\Http\Requests\SizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeRequest $request)
    {
        Size::create( $request->all() );
        return redirect()->back()->with('message', "سایز {$request->title} با موفقیت ثبت شد");
    }

    /**
     * Display the specified size.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     * 
     * public function show(Size $size)
     * {
     *   //
     * }
     */

    /**
     * Show the form for editing the specified size.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        return view('panel.size', [
            'sizes' => Size::with('size_group')->latest()->get(),
            'size' => $size->load('size_group'),
            'page_name' => 'size',
            'page_title' => "ویرایش سایز {$size->title}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified size in storage.
     *
     * @param  \App\Http\Requests\SizeRequest  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(SizeRequest $request, Size $size)
    {
        $size->update( $request->all() );
        return redirect()->back()->with('message', "سایز {$size->title} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified size from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return redirect( route('size.index') )->with('message', "سایز {$size->title} با موفقیت حذف شد");
    }
}
