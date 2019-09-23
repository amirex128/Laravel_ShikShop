<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Support\Facades\Input;

class ProvinceController extends Controller
{

    public function index()
    {

        return view('panel.provider');
    }


    public function create()
    {

        return view('panel.add-provider', ['status' => 1]);
    }


    public function store()
    {

        $this->validate(request(), [
            "title" => "required",
        ]);


        if (request()->has('image')) {
            $as=$this->upload_image(Input::file('image'));
        }else{
            $as="";
        }
        Provider::create([
            "title" => request()->title,
            "description" => request()->description ?: "",
            "banner" => $as,
        ]);
        return redirect()->route('provider.index');


    }


    public function edit(Provider $Provider)
    {
        return view('panel.add-provider', ['Provider' => $Provider, 'status' => 2]);

    }


    public function update(Provider $Provider)
    {

        if (request()->has('image')) {
            $as=$this->upload_image(Input::file('image'));
            $Provider->update([
                "title" => request()->title,
                "description" => request()->description,
                "banner" => $as,
            ]);
        } else {
            $Provider->update([
                "title" => request()->title,
                "description" => request()->description,
            ]);
        }


        return redirect()->route('provider.index');


    }


    public function destroy(Provider $Provider)
    {
        $Provider->delete();

        return redirect()->route('provider.index');
    }

    /**
     * Show the filtered articles from storage.
     *
     * @param String $query
     * @return \Illuminate\Http\Response
     */

}
