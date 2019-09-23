<?php

	namespace App\Http\Controllers\panel;

	use App\Http\Controllers\Controller;
	use App\Models\Brand;
	use App\Models\Category;
	use App\Models\Color;
	use App\Models\Design;
	use App\Models\Product;
    use App\Models\Provider;
    use App\Models\Size;
	use App\Models\Specification;
	use App\Robot;
	use Illuminate\Http\Request;

	class RobotController extends Controller
	{

		public function __construct()
		{

			$this->middleware(['web' , 'admin'])->except('storeApi');
		}

		public function index()
		{

			$categories = Category::all();
			$robots = Robot::all();

			return view('panel/robot/index' , compact(['categories' , 'robots']));
		}

		public function create()
		{
		}

		public function store(request $request)
		{

				    Robot::create([
		    "origin" => $request->origin , "category_id" => intval($request->destination) ,
	    ]);


			return redirect('panel/robot')->with('create' , "دسته بندی ربات شما با موفقیت اضافه شد");

		}

		public function storeApi(Request $request)
		{

			if( !$request->isJson())
				return "not_JSON";

			if( !$request->filled(['product_name' , 'product_price' , 'product_img' , 'product_status']))
				return "empty_required";

			$robot['brand_name'] = $request->input('brand_name' , "");
			$robot['provider_name'] = $request->input('provider_name' , "");
			$robot['provider_description'] = $request->input('provider_description' , "");
			$robot['brand_description'] = $request->input('brand_description' , "");
			$robot['category_name'] = $request->input('category_name' , "");
			$robot['color'] = $request->input('color' , "");
			$robot['design'] = $request->input('design' , "");
			$robot['design_name'] = $request->input('design_name' , "");
			$robot['product_size'] = $request->input('product_size' , "");
			$robot['product_name'] = $request->input('product_name');
			$robot['product_description'] = $request->input('product_description' , "");
			$robot['product_price'] = $request->input('product_price');
			$robot['product_offer'] = $request->input('product_offer' , "");
			$robot['product_buy_url'] = $request->input('product_buy_url' , "");
			$robot['product_img'] = $request->input('product_img');
			$robot['product_gallery'] = $request->input('product_gallery' , "");
			$robot['product_attribute'] = $request->input('product_attribute' , "");
			$robot['product_status'] = $request->input('product_status');


			if($old = Product::whereName($robot['product_name'])->first()){
				$old->price = $robot['product_price'];
				$old->status = $robot['product_status'];
				$old->save();

				return "updated";

			}else{
				$new = Product::create([
					"name" => $robot['product_name'] ,
					"description" => $robot['product_description'] ,
					"price" => $robot['product_price'] ,
					"offer" => $robot['product_offer'] ,
					"link" => $robot['product_buy_url'] ,
					"photo" => $robot['product_img'] ,
					"gallery" => $robot['product_gallery'] ,
					"status" => $robot['product_status'] ,
				]);

				if( !empty($robot['category_name'])){
					if($cate_robot = Robot::where('origin' , $robot['category_name'])->first()){
						$new->categories()->sync($cate_robot->category_id);
					}
				}

				if( !empty($robot['brand_name']) || !empty($robot['brand_description'])){
					if($brand = Brand::where('title' , $robot['brand_name'])->first()){
						$new->update([
							"brand_id" => $brand->id ,
						]);
					}else{
						$new->update([
							"brand_id" => Brand::create(['title' => $robot['brand_name']?:"" , 'description' => $robot['brand_description']??""])->id ,
						]);
					}

				}

                if( !empty($robot['provider_name'])){
                    if($provider = Provider::where('title' , $robot['provider_name'])->first()){
                        $new->update([
                            "provider_id" => $provider->id ,
                        ]);
                    }else{
                        $new->update([
                            "provider_id" => Provider::create(['title' => $robot['provider_name'] , 'description' => isset($robot['provider_description'])?$robot['provider_description']:""])->id ,
                        ]);
                    }
                }
				if( !empty($robot['design_name'])){

					if($design = Design::where('title' , $robot['design_name'])->first()){
						$new->update([
							"design_id" => $design->id ,
						]);
					}else{
						$new->update([
							"design_id" => Design::create(['title' => $robot['design_name'] , 'description' => $robot['design']])->id ,
						]);
					}

				}

				if( !empty($robot['product_size'])){

					if($Size = Size::where('size' , $robot['product_size'])->first()){
						$new->update([
							"size_id" => $Size->id ,
						]);
					}else{
						$new->update([
							"size_id" => Size::create(['size' => $robot['product_size']])->id ,
						]);
					}

				}

				if( !empty($robot['color']) && is_array($robot['color'])){

					foreach($robot['color'] as $colorr){

						if($Color = Color::where('value' , $colorr[1])->first()){

							$new->color()->attach($Color->id);

						}else{
							$color = Color::create(['name' => $colorr[0] , 'value' => $colorr[1]]);
							$new->color()->attach($color->id);
						}
					}

				}

				if( !empty($robot['product_attribute'])){
					if(is_array($robot['product_attribute'])){

						foreach($robot['product_attribute'] as $attribute){
							$new->specification()->create([
								"key" => $attribute[0] ,
								"value" => $attribute[1] ,
							]);
						}

					}else{
						$new->specification()->create([
							"key" => $robot['product_attribute'][0] ,
							"value" => $robot['product_attribute'][1] ,
						]);
					}
				}

                $new->save();
				return "product_added";
			}

		}

		public function edit(Robot $robot)
		{

			return view('panel/robot/edit' , ['robot' => $robot , 'categories' => Category::all()]);

		}

		public function update(Request $request , Robot $robot)
		{

			$robot->update([
				'origin' => $request->origin ,
				'category_id' => $request->destination ,
			]);

			return redirect('panel/robot');
		}

		public function destroy(Robot $robot)
		{

			$robot->delete();

			return redirect('/panel/robot');
		}
	}
