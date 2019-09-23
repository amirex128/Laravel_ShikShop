<?php
	
	namespace App\Http\Controllers\panel;
	
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Http\Requests\Slider;
	use App\Http\Requests\Poster;
	use App\Http\Requests\Info;
	use App\Http\Requests\SocialLink;
	use App\Http\Requests\ShippingCost;
	use Carbon\Carbon;
	use App\Models\OrderProducts;
	use App\Models\Order;
	use App\Models\Review;
	use App\Models\Product;
	use App\Models\Option;
	use App\Models\ProductVariation;
	use Illuminate\Support\Facades\Validator;
	
	class PanelController extends Controller
	{
		
		public function index($total_type = 'daily')
		{
			
			return view('panel.index' , [
				'orders' => Order::list() ,
				'orders_count' => Order::count() ,
				'product_count' => Product::count() ,
				'page_name' => 'داشبورد' ,
				// 'total_income'  => Order::total_income(),
				'order_compare' => Order::compare() ,
				'total_sales' => Order::total($total_type) ,
				'total_type' => $total_type ,
				'options' => $this->options(['site_name' , 'site_logo']) ,
			]);
		}
		
		public function setting()
		{
			
			return view('panel.setting' , [
				'page_name' => 'setting' ,
				'term_warranty' => Option::where('name' , 'term_warranty')->first() ,
				'follow_orders' => Option::where('name' , 'follow_orders')->first() ,
				'page_title' => 'تنظیمات' ,
				'options' => $this->options([
					'slider' , 'posters' , 'site_name' , 'site_description' , 'site_logo' ,
					'shop_phone' , 'shop_address' , 'social_link' , 'shipping_cost' , 'watermark' ,
				]) ,
			]);
		}
		
		public function slider(Slider $req)
		{
			
			$option = Option::where('name' , 'slider')->first();
			$option_value = json_decode($option->value , TRUE);
			$slider = $req->slides;
			
			foreach($req->slides as $key => $item){
				if(isset($item['photo'])){
					$file_path = public_path() . '/slider/' . $option_value[$key]['photo'];
					if(file_exists($file_path)){
						unlink($file_path);
					}
					
					$photoName = substr(md5(time()) , 0 , 8) . '.' . $item['photo']->getClientOriginalExtension();
					$item['photo']->move(public_path('slider') , $photoName);
					
					$slider[$key]['photo'] = $photoName;
				}else{
					$slider[$key]['photo'] = $option_value[$key]['photo'];
				}
			}
			
			$slider = json_encode($slider);
			$option->update(['value' => $slider]);
			
			return redirect()->back()->with('message' , 'اسلایدر با موفقیت بروز رسانی شد');
		}
		
		public function poster(Poster $req)
		{
			
			$option = Option::where('name' , 'posters')->first();
			$option_value = json_decode($option->value , TRUE);
			$posters = $req->posters;
			
			foreach($req->posters as $key => $item){
				if(isset($item['photo'])){
					$file_path = public_path() . '/poster/' . $option_value[$key]['photo'];
					if(file_exists($file_path)){
						unlink($file_path);
					}
					
					$photoName = substr(md5(time()) , 0 , 8) . '.' . $item['photo']->getClientOriginalExtension();
					$item['photo']->move(public_path('poster') , $photoName);
					
					$posters[$key]['photo'] = $photoName;
				}else{
					$posters[$key]['photo'] = $option_value[$key]['photo'];
				}
			}
			
			$posters = json_encode($posters);
			$option->update(['value' => $posters]);
			
			return redirect()->back()->with('message' , 'پوستر ها با موفقیت بروز رسانی شدند');
		}
		
		public function info()
		{
			$option = Option::select('id' , 'name' , 'value')->whereIn('name' , [
				'site_name' , 'site_description' , 'site_logo' , 'watermark' , 'shop_phone' , 'shop_address' ,
			])->get();
			
			$options = [];
			foreach($option as $item){
				$options[$item['name']] = ['id' => $item['id'] , 'value' => $item['value']];
			}
			$info = \request()->all();
			
			if(isset($info['term_warranty'][1])){
				
				$photoName1 = substr(md5(time() * 5) , 0 , 8) . '.' . $info['term_warranty'][1]->getClientOriginalExtension();
				$info['term_warranty'][1]->move(public_path() , $photoName1);
				
				$info['term_warranty'][1] = $photoName1;
				
				Option::where('name' , 'term_warranty')->update([
					"value" => json_encode($info['term_warranty']) ,
				]);
				
			}else{
				$b = json_decode(Option::where('name' , 'term_warranty')->first()->value)[1];
				Option::where('name' , 'term_warranty')->update([
					"value" => json_encode([$info['term_warranty'][0] , $b]) ,
				]);
			}

//			return $req->all();
			
			if(isset($info['follow_orders'][3])){
				
				$photoName2 = substr(md5(time() * 4) , 0 , 8) . '.' . $info['follow_orders'][3]->getClientOriginalExtension();
				$info['follow_orders'][3]->move(public_path() , $photoName2);
				
				$info['follow_orders'][3] = $photoName2;
				
				Option::where('name' , 'follow_orders')->update([
					"value" => json_encode($info['follow_orders']) ,
				]);
				
			}else{
				$a = json_decode(Option::where('name' , 'follow_orders')->first()->value)[3];
				Option::where('name' , 'follow_orders')->update([
					"value" => json_encode([$info['follow_orders'][0] , $info['follow_orders'][1] , $info['follow_orders'][2] , $a]) ,
				]);
			}
			
			if(isset($info['logo'])){
				
				$photoName3 = substr(md5(time() * 2) , 0 , 8) . '.' . $info['logo']->getClientOriginalExtension();
				$info['logo']->move(public_path('logo') , $photoName3);
				
				$options['site_logo']['value'] = $photoName3;
			}
			
			if(isset($info['watermark'])){
				
				$photoName4 = substr(md5(time() * 3) , 0 , 8) . '.' . $info['watermark']->getClientOriginalExtension();
				$info['watermark']->move(public_path('logo') , $photoName4);
				
				$options['watermark']['value'] = $photoName4;
			}
			
			$options['site_name']['value'] = $info['site_name'];
			$options['site_description']['value'] = $info['description'];
			$options['shop_phone']['value'] = $info['phone'];
			$options['shop_address']['value'] = $info['address'];
			
			foreach($options as $item){
				$option = Option::find($item['id']);
				$option->value = $item['value'];
				$option->save();
			}
			
			return redirect()->back()->with('message' , 'اطلاعات کلی با موفقیت بروز رسانی شدند');
		}
		
		public function social_link(SocialLink $req)
		{
			
			$option = Option::select('id' , 'value')->where('name' , 'social_link')->get();
			$option_id = $option[0]->id;
			$option_value = json_decode($option[0]->value , TRUE);
			
			$option_value['instagram'] = $req->instagram;
			$option_value['telegram'] = $req->telegram;
			$option_value['twitter'] = $req->twitter;
			$option_value['facebook'] = $req->facebook;
			
			$option = Option::find($option_id);
			$option->value = json_encode($option_value);
			$option->save();
			
			return redirect()->back()->with('message' , 'لینک شبکه های اجتماعی با موفقیت بروز رسانی شدند');
		}
		
		public function dollar_cost($dollar_cost)
		{
			
			Validator::make(['dollar_cost' => $dollar_cost] , [
				'dollar_cost' => 'required|min:1|digits:10|integer' ,
			])->validate();
			
			Option::where('name' , 'dollar_cost')->first()->update(['value' => $dollar_cost]);
			
			return redirect()->back()->with('message' , 'قیمت دلار با موفقیت بروز رسانی شد');
		}
		
		public function shipping_cost(ShippingCost $req)
		{
			
			$option = Option::where('name' , 'shipping_cost')->first();
			$option_value = json_decode($option->value , TRUE);
			for($i = 1 ; $i < 5 ; ++$i){
				$option_value["model$i"]['name'] = $req->shipping_cost["model$i"]['name'];
				$option_value["model$i"]['cost'] = $req->shipping_cost["model$i"]['cost'];
			}
			
			$option->update(['value' => json_encode($option_value)]);
			
			return redirect()->back()->with('message' , 'هزینه های ارسال با موفقیت بروز رسانی شدند');
			
		}
		
		public function warrantyApi()
		{
			
			 $a= Option::select('value')->whereName('term_warranty')->first();

			 $collection=collect(["term"=>json_decode($a->value)[0],"img"=>json_decode($a->value)[1]]);
			
			return $collection;
		}
		
		public function followOrder()
		{
			
			$b= Option::select('value')->whereName('follow_orders')->first();
			
			$collection=collect(["first"=>json_decode($b->value)[0],"second"=>json_decode($b->value)[1],"link"=>json_decode($b->value)[2],"img"=>json_decode($b->value)[3]]);
			
			return $collection;
			
		}
	}
