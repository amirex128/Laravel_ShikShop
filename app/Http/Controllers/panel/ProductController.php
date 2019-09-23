<?php

namespace App\Http\Controllers\panel;

use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Provider;
use App\Models\Size;
use App\Models\Design;
use function GuzzleHttp\Promise\all;
use Morilog\Jalali\Jalalian;
use Cookie;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.products', [
            'products' => Product::productCard(),
            'page_name' => 'products',
            'page_title' => 'محصولات',
            'options'=> $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.add-product', [
            'groups'      => $this->Get_sub_groups(),
            'colors'      => Color::latest()->get(),
            'brands'      => Brand::latest()->get(),
            'provider'      => Provider::latest()->get(),
            'sizes'       => Size::latest()->get(),
            'categories_new'     => Category::all(),
            'designs'     => Design::latest()->get(),
            'page_name'   => 'add_product',
            'page_title'  => 'ثبت محصول',
            'options'     => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $images = $this->upload($request->images);

	    $product = Product::create([
            "name"=>$request->name,
            "link"=>$request->link,
            "brand_id"=>$request->brand_id,
            "provider_id"=>$request->provider_id,
            "size_id"=>$request->size_id,
            "design_id"=>$request->design_id,
            "price"=>$request->price,
            "offer"=>$request->offer,
            "status"=>$request->status,

            "special"=>$request->special,
            "description"=>$request->description,
            "photo"=>( isset($images[0]) ) ? $images[0] : null,
            "gallery"=>$images,
	    ]);
	    

        $product->categories()->attach( $request->categories );
        $product->color()->attach( $request->colors );

        $product->specs()->createMany( array_filter( $request->spec, function( $value ) {
            return !empty($value['key']) && !empty($value['value']);
        }));

        return redirect()->action(
            'panel\ProductController@edit', ['id' => $product->id]
        )->with('message', 'محصول '.$product->name.' با موفقیت ثبت شد .');
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {


    	
        return view('panel.add-product', [
            'product'     => Product::productInfo($product),
            'product2'     => $product,
            'groups'      =>Category::all(),
            'colors'      => Color::latest()->get(),
            'brands'      => Brand::latest()->get(),
            'provider'      => Provider::latest()->get(),
            'sizes'       => Size::latest()->get(),
            'designs'     => Design::latest()->get(),
            'categories_new'     => Category::all(),
            'page_name'   => 'products',
            'page_title'  => 'ویرایش محصول ',
            'options'     => $this->options(['site_name', 'site_logo']),
	        'thatProduct'=>$product
        ]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $images = array_merge( $this->upload($request->images), $product->gallery );
        
	    if ($request->deleted_images)
	    {
		    $deleted = json_decode($request->deleted_images, true);
		    foreach ($deleted as $img)
		    {
			    if (($key = array_search($img, $images)) !== false) unset($images[$key]);
		    }
        }

        if ( collect( $images )->isEmpty() )
            return redirect()->back()->withErrors(['لطفا حداقل یک عکس برای محصول انتخاب کنید']);
        
	    $product->update( [
		    "name"=>$request->name,
		    "link"=>$request->link,
		    "brand_id"=>$request->brand_id,
		    "provider_id"=>$request->provider_id,
		    "size_id"=>$request->size_id,
		    "design_id"=>$request->design_id,
		    "price"=>$request->price,
		    "offer"=>$request->offer,
		    "status"=>$request->status,
		    "special"=>$request->special,
		    "description"=>$request->description,
		    "photo"=> collect( $images )->first(),
		    "gallery"=>$images,
	    ]);
	
	
	    $product->categories()->sync( $request->categories );
	    $product->color()->sync( $request->colors );
        $product->specs()->delete();
    
	    $product->specs()->createMany( array_filter( $request->spec, function( $value ) {
		    return !empty($value['key']) && !empty($value['value']);
	    }));

        return redirect()->back()->with('message', 'محصول '.$product->name.' با موفقیت بروزرسانی شد .');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect( route('product.index') )->with('message', 'محصول '.$product->title.' با موفقیت حذف شد .');
    }

    /**
     * Show the filtered products from storage.
     *
     * @param  String  $query
     * @return \Illuminate\Http\Response
     */
    public function search ($query = '')
    {
        return view('panel.products', [
            'products' => Product::productCard($query),
            'page_name' => 'products',
            'query' => $query,
            'page_title' => 'جستجوی محصولات برای "' . $query . '"',
            'options'=> $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Upload the image and insert watermark on it
     *
     * @param File $images
     * @return Array
     */
    public function upload ($input)
    {
        if ($input != [])
        {
            $images = [];
            $watermark = $this->options(['watermark'])['watermark'];
            foreach (Input::file('images') as $photo)
            {
                $images[] = $this->upload_image($photo, 500, public_path('logo/' . $watermark) );
            }
            return $images;
        }
        else
        {
            return [];
        }
    }
}
