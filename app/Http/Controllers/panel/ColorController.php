<?php

namespace App\Http\Controllers\panel;

use App\Models\Color;
use App\Http\Requests\ColorRequest;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    /**
     * Display a listing of the colors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.color', [
            'colors' => Color::latest()->get(),
            'page_name' => 'color',
            'page_title' => 'ثبت رنگ',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new color.
     *
     * @return \Illuminate\Http\Response
     * 
     * public function create()
     * {
     *    //
     * }
     */

    /**
     * Store a newly created color in storage.
     *
     * @param  \App\Http\Requests\ColorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorRequest $request)
    {
        Color::create( $request->all() );
        return redirect()->back()->with('message', "رنگ {$request->name} با موفقیت ثبت شد");
    }

    /**
     * Display the specified color.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     * 
     * public function show(Color $color)
     * {
     *      //
     * }
     */

    /**
     * Show the form for editing the specified color.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('panel.color', [
            'colors' => Color::latest()->get(),
            'color' => $color,
            'page_name' => 'color',
            'page_title' => "ویرایش رنگ {$color->name}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified color in storage.
     *
     * @param  \App\Http\Requests\ColorRequest  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(ColorRequest $request, Color $color)
    {
        $color->update( $request->all() );
        return redirect()->back()->with('message', "رنگ {$color->name} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified color from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return redirect( route('color.index') )->with('message', "رنگ {$color->name} با موفقیت حذف شد");
    }
}
