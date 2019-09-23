<?php

namespace App\Http\Controllers\panel;

use App\Models\Design;
use App\Http\Requests\DesignRequest;
use App\Http\Controllers\Controller;

class DesignController extends Controller
{
    /**
     * Display a listing of the Designs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.design', [
            'designs' => Design::latest()->get(),
            'page_name' => 'design',
            'page_title' => 'ثبت طرح',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Design.
     *
     * @return \Illuminate\Http\Response
     *
     * public function create()
     * {
     *   //
     * }
     */ 

    /**
     * Store a newly created Design in storage.
     *
     * @param  \App\Http\Requests\DesignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DesignRequest $request)
    {
        Design::create( $request->all() );
        return redirect()->back()->with('message', "طرح {$request->title} با موفقیت ثبت شد");
    }

    /**
     * Display the specified design.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     * 
     * public function show(Design $design)
     * {
     *   //
     * }
     */

    /**
     * Show the form for editing the specified design.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function edit(Design $design)
    {
        return view('panel.design', [
            'designs' => Design::latest()->get(),
            'design' => $design,
            'page_name' => 'design',
            'page_title' => "ویرایش طرح {$design->title}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified design in storage.
     *
     * @param  \App\Http\Requests\DesignRequest  $request
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function update(DesignRequest $request, Design $design)
    {
        $design->update( $request->all() );
        return redirect()->back()->with('message', "طرح {$design->title} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified design from storage.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design)
    {
        $design->delete();
        return redirect( route('design.index') )->with('message', "طرح {$design->title} با موفقیت حذف شد");
    }
}
