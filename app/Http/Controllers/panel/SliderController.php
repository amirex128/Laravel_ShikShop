<?php
	
	namespace App\Http\Controllers\panel;
	
	use App\Http\Controllers\Controller;
	use App\Http\Resources\getSlider;
	use App\Http\Resources\postSlider;
	use App\Http\Resources\Users;
	use App\Models\Category;
	use App\Models\Product;
	use App\slider;
	use function PHPSTORM_META\type;
	
	class SliderController extends Controller
	{
		
		public function index()
		{
			
			for($a = 1 ; $a <= 25 ; $a++){
				
				$ss = slider::firstOrCreate(
					['id' => $a] , [
						'id' => $a ,
						'title' => "" ,
						'status' => "active" ,
						'type' => "" ,
						'selected' => [] ,
					]
				);
				
			}
			
			return view('panel.sliders' , [
				"products" => Product::all() ,
				"categories" => Category::all() ,
				"slides" => slider::all() ,
			]);
			
		}
		
		public function store()
		{

//			return request()->all();
			
			foreach(request()->slides as $key => $record){
				$urlImage = '';
				if(isset($record['img'])){
					$name = time() . "__" . $record['img']->getClientOriginalName();
					$urlImage = $record['img']->move('slider/' , $name);
				}
				if( !array_key_exists('slider' , $record)){
					$record['slider'] = '';
				}
				if( !array_key_exists('type' , $record)){
					$record['type'] = '';
				}
				if( !array_key_exists('status' , $record)){
					$record['status'] = '';
				}
				if( !array_key_exists('title' , $record)){
					$record['title'] = '';
				}
				if(empty($urlImage)){
					slider::updateOrCreate(
						['id' => $key] ,
						['title' => $record['title'] ,
							'status' => $record['status'] ,
							'type' => $record['type'] ,
							'selected' => $record['slider'] ,
						]);
				}else{
					slider::updateOrCreate(
						['id' => $key] ,
						['title' => $record['title'] ,
							'status' => $record['status'] ,
							'type' => $record['type'] ,
							'img' => $urlImage ,
							'selected' => $record['slider'] ,
						]);
				}
				
			}
			
			return redirect()->back();
		}
		
		public function storeApi()
		{
                        $dd= request()->all();
			$id=slider::find($dd[0]["id"]);
				if($id->type == "category"){
					if(!empty($id->selected)){
						foreach($id->selected as $a){
							foreach(Category::find($a)->Products()->all() as $product){
								
								$array[] = $product->only('id' , 'name' , 'price' , 'photo' , 'offer');
								
							}
						}
						
						return $array;
						
					}else{
						return "no selected";
					}
					
				}elseif($id->type == "product"){
					
					if(!empty($id->selected) > 0){
						foreach($id->selected as $a){
							$array[] = Product::find($a)->only('id' , 'name' , 'price' , 'photo' , 'offer');
						}
						
						return $array;
						
					}else{
						return "no selected";
					}
					
				}
			
			
		}
		
		public function getApi()
		{
			
			return slider::select('id' , 'img' , 'status')->get();
			
		}
		
	}
