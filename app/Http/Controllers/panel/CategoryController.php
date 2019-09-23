<?php
	
	namespace App\Http\Controllers\panel;
	
	use App\Models\Category;
	use App\Http\Requests\CategoryRequest;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Input;
	use Intervention\Image\Facades\Image;
	
	class CategoryController extends Controller
	{
		/**
		 * Display a listing of the Categories.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			return view('panel.category', [
				'categories' => $this->Get_sub_groups(),
				'page_name' => 'category',
				'page_title' => 'گروه بندی محصولات',
				'options' => $this->options(['site_name', 'site_logo']),
                'categories_new'=>Category::all()
			]);
		}
		
		/**
		 * Show the form for creating a new Category.
		 *
		 * @return \Illuminate\Http\Response
		 *
		 * public function create()
		 * {
		 *   //
		 * }
		 */
		
		/**
		 * Store a newly created Category in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(CategoryRequest $request)
		{
			Category::create(array_merge([
				"title"=>$request->title,
				"parent"=>$request->parent,
				"description"=>$request->description,
			], [
				'icon' => Input::file('icon') ? $this->upload_image( Input::file('icon') ) : null,
				'banner' => Input::file('banner') ? $this->upload_image( Input::file('banner') ) : null,
			]));
			
			return redirect()->back()->with('message', 'گروه '.$request->title.' با موفقیت ثبت شد .');
		}
		
		/**
		 * Display the specified Category.
		 *
		 * @param  \App\models\Category  $category
		 * @return \Illuminate\Http\Response
		 */
		public function show(Category $category)
		{
			return view('panel.category', [
				'categories' => $category->childs()->get(),
				'category' => $category,
				'breadcrumb' => $this -> breadcrumb($category),
				'page_name' => 'group',
				'page_title' => 'گروه های زیرمجموعه ' . $category->title,
				'options' => $this->options(['site_name', 'site_logo'])
			]);
		}
		
		/**
		 * Show the form for editing the specified Category.
		 *
		 * @param  \App\models\Category  $category
		 * @return \Illuminate\Http\Response
		 */
		public function edit(Category $category)
		{
			return view('panel.category', [
				'categories' => $category->childs()->get(),
				'category' => $category,
				'id' => $category->id,
				'breadcrumb' => $this -> breadcrumb($category),
				'page_name' => 'category',
				'page_title' => 'ویرایش گروه ' . $category->title,
				'options' => $this->options(['site_name', 'site_logo'])
			]);
		}
		
		/**
		 * Update the specified Category in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  \App\models\Category  $category
		 * @return \Illuminate\Http\Response
		 */
		public function update(CategoryRequest $request, Category $category)
		{
			if ($request->hasFile('icon'))
			{
				$icon = $this->upload_image( Input::file('icon') );

			}
			else
			{
				$icon = $category->icon;
			}
			
			if ($request->hasFile('banner'))
			{
				$banner = $this->upload_image( Input::file('banner') );

			}
			else
			{
				$banner = $category->banner;
			}
			
			$category->update(array_merge($request -> all(), [
				'icon' => $icon,
				'banner' => $banner
			]));
			return redirect()->back()->with('message', 'گروه '.$request->title.' با موفقیت بروز رسانی شد .');
		}
		
		/**
		 * Remove the specified Category from storage.
		 *
		 * @param  \App\models\Category  $category
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Category $category)
		{
			$category->delete();
			return redirect( route('category.index') )->with('message', 'گروه '.$category->title.' با موفقیت حذف شد .');
		}
	}
