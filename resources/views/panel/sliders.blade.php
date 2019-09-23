@extends('panel.master.main')

@section('styles')
	<?php $styles = [
// select2 CSS
//  Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css' ,
// Custom CSS
		'dist/css/style.css'
	]; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach

	<style>
		.project-gallery a {
			filter: grayscale(80%);
			box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
			-webkit-box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
			-moz-box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
			transition: box-shadow 300ms, filter 300ms, border 300ms;
		}

		.project-gallery a.selected {
			filter: grayscale(0%);
			border: 1px solid #f83f36;
			box-shadow: 0px 0px 20px -5px #f83f36 !important;
		}

		.project-gallery a:hover {
			box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
			-webkit-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
			-moz-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
		}

		.photo-actions {
			width: 60px;
			position: absolute;
			top: 10px;
			left: 10px;
		}

		.photo-actions a, .photo-actions span {
			width: 20px;
			height: 20px;
			margin: 0px !important;
			padding: 4px;
			box-shadow: 0px 0px 0px 0px #000;
			transition: box-shadow 300ms;
		}

		.photo-actions a:hover, .photo-actions span:hover {
			box-shadow: 0px 0px 15px -5px #000;
		}

		.vertical-pills .tab-content {
			padding-right: 15px;
		}

		.fa {
			color: #737373;
		}
	</style>
@endsection

@section('content')
	<div id="app-vue" class="container">
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">تنظیمات</h5>
			</div>

			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>تنظیمات</span></li>
					<li>داشبورد</li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pt-0">
							<div class="form-wrap">
								<h6 class="txt-dark flex flex-middle  capitalize-font"><i
										 class="fa fa-desktop font-20 txt-grey ml-10"
										 aria-hidden="true"></i>افزودن اسلایدر</h6>
								<hr class="light-grey-hr"/>

								<div class="panel-body">
									@if(session()->has('message'))
										<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert"
											        aria-hidden="true">&times;
											</button>
											{{ session()->get('message') }}
										</div>
									@endif

									<div class="pills-struct vertical-pills">
										<ul role="tablist" class="nav nav-pills ver-nav-pills pull-right"
										    id="myTabs_10">
											<li v-for="item in 32"
											    role="presentation"><a aria-expanded="false"
											                           data-toggle="tab" role="tab"
											                           :href="'#slide'+item">اسلاید @{{
													item }}



												</a></li>
										</ul>

										<div class="tab-content" id="myTabContent_10">
											@for ($item = 1; $item <= 32; $item++)

												<div id="slide{{$item}}" class="tab-pane fade row "
												     role="tabpanel">
													<form action="/panel/sliders"
													      enctype="multipart/form-data" method="POST">

														<div class="col-md-8">
															<h5 class="text-center">اسلاید
																شماره {{ $item }}</h5>
															<div class="form-wrap">
																<div class="form-group">
																	<label class="control-label mb-10"
																	       for="title">عنوان
																		اسلاید </label>
																	<div class="input-group">
																		<input type="text"
																		       value="{{$slides->find($item)->title}}"
																		       name="slides[{{$item}}][title]"
																		       class="form-control"
																		       id="title"
																		       placeholder="برای مثال : Apple_iPhone_X_back">
																		<div class="input-group-addon">
																			<i class="fa fa-header"
																			   aria-hidden="true"></i>
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	<label class="control-label mb-10">وضعیت
																		اسلاید </label>
																	<div class="form-check">
																		<input
																			 class="form-check-input"
																			 type="radio"
																			 name="slides[{{$item}}][status]"
																			 id="status1{{$item}}"
																			 value="active" {{$slides->find($item)->status=="active"?"checked":''}}>
																		<label
																			 class="form-check-label"
																			 for="status1{{$item}}">
																			فعال
																		</label>
																	</div>
																	<div class="form-check">
																		<input
																			 class="form-check-input"
																			 type="radio"
																			 name="slides[{{$item}}][status]"
																			 id="status2{{$item}}"
																			 value="deactivate"
																			 {{$slides->find($item)->status=="deactivate"?"checked":''}}>
																		<label
																			 class="form-check-label"
																			 for="status2{{$item}}">
																			غیر فعال
																		</label>
																	</div>
																</div>
																<div class="form-group">
																	<label class="control-label mb-10">نوع
																		اسلاید </label>
																	<div class="form-check">
																		<input
																			 id="type1{{$item}}"
																			 class="form-check-input"
																			 type="radio"
																			 name="slides[{{$item}}][type]"
																			 v-model="show[{{$item}}]"
																			 value="product"
																		>

																		{{--@{{ show[@php echo $item @endphp]=@php echo $slides->find($item)->type=="product".$item?"'product{$item}'":"''"; @endphp }}--}}
																		{{--@{{ show[{{$item}}]={{$slides->find($item)->type=="product".$item?"product{$item}":''}} }}--}}

																		<label
																			 class="form-check-label"
																			 for="type1{{$item}}">
																			محصول
																		</label>
																	</div>
																	<div class="form-check">
																		<input
																			 id="type2{{$item}}"
																			 class="form-check-input"
																			 type="radio"
																			 name="slides[{{$item}}][type]"
																			 v-model="show[{{$item}}]"
																			 value="category">
																		{{--@{{ show[{{$item}}]={{$slides->find($item)->type=="category".$item?"category{$item}":''}} }}--}}
																		<label
																			 class="form-check-label"
																			 for="type2{{$item}}">
																			دسته بندی
																		</label>
																	</div>
																</div>
																<div v-if="show[{{$item}}]=='product'"
																     class="form-group" id="product">
																	<label for="select-product">انتخاب
																		محصول</label>
																	<select multiple
																	        class="form-control js-example-basic-single"
																	        name="slides[{{$item}}][slider][]"
																	        id="select-product{{$item}}">
																		@foreach($products->sortBy('name') as $product)
																			<option
																				 {{in_array($product->id,$slides->find($item)->selected ?: [""])?"selected":""}}

																				 value="{{$product->id}}">{{$product->name}}</option>
																		@endforeach
																	</select>
																	<small>با نگه داشتن کلید ctrl
																		میتوانید چند محصول را انتخاب
																		نمایید.
																	</small>
																</div>
																<div v-if="show[{{$item}}]=='category'"
																     class="form-group" id="category">
																	<label for="select-category">انتخاب
																		دسته بندی</label>
																	<select multiple
																	        class="form-control"
																	        name="slides[{{$item}}][slider][]"
																	        id="select-category{{$item}}">
																		@foreach($categories->sortBy('title') as $category)
																			<option
																				 {{in_array($category->id,$slides->find($item)->selected ?: [""])?"selected":""}}

																				 value="{{$category->id}}">{{$category->title}}</option>
																		@endforeach
																	</select>
																	<small>با نگه داشتن کلید ctrl
																		میتوانید چند دسته بندی را
																		انتخاب نمایید.
																	</small>
																</div>
															</div>
														</div>
														<div class="col-md-4">
															<label class="control-label mb-10">تصویر
																اسلاید </label>

															<div class="mt-10 mb-10">
																<input type="file"
																       name="slides[{{$item}}][img]"
																       data-default-file="http://shikshop.net/{{$slides->find($item)->img}}"
																       id="input-file-now{{$item}}"
																       class="dropify{{$item}}"/>
															</div>
														</div>
														<div class="w-100"></div>
														<div class="col-md-12">
															<hr class="hr-line-dashed">

														</div>
														<div class="form-actions">
															<button
																 class="btn btn-info btn-icon right-icon mr-10 pull-left"
																 id="btn-send"><i
																	 class="fa fa-check"></i>
																<span>ذخیره اسلایدر</span></button>
															<div class="clearfix"></div>
														</div>
														@csrf
													</form>
												</div>

											@endfor


										</div>

									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Row -->

	</div>
@endsection

@section('scripts')
	<?php $scripts = [
// jQuery
		'vendors/bower_components/jquery/dist/jquery.min.js' ,
// Bootstrap Core JavaScript
		'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js' ,
// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js' ,
// Tinymce JavaScript
		'vendors/bower_components/tinymce/tinymce.min.js' ,
// Tinymce Wysuhtml5 Init JavaScript
		'dist/js/tinymce-data.js' ,
// Gallery JavaScript
		'dist/js/isotope.js' ,
		'dist/js/lightgallery-all.js' ,
		'dist/js/froogaloop2.min.js' ,
		'dist/js/gallery-data.js' ,
// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js' ,
// Bootstrap Daterangepicker JavaScript
		'vendors/bower_components/dropify/dist/js/dropify.min.js' ,
// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js' ,
// Select2 JavaScript
// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js' ,
// Bootstrap Tagsinput JavaScript
		'vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js' ,
// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js' ,
// Init JavaScript
		'dist/js/init.js' ,
// Setting page
		'dist/js/setting.js'
	]; ?>
	<script src="{{asset('/vue.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script src="{{asset('/dist/jquery-3.3.1.min.js')}}"></script>
	<script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

		var app = new Vue({
			el: '#app-vue',
			data: {
				show: {
					@for($i=1;$i<=32;$i++)
					'{{$i}}' : "",
						@endfor
		}

		}
		,
		methods: {


		}
		,
		mounted()
		{
			@for($i=1;$i<=32;$i++)
				@if ($slides->find($i)->type=="product")
					this.show["{{$i}}"] = 'product';
				@elseif($slides->find($i)->type=="category")
					this.show["{{$i}}"] = 'category';
				@endif
			@endfor
		}

		})
	</script>
	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach
	@for ($i = 0; $i < 43; $i++)
		<script> $('.dropify{{$i}}').dropify(); </script>

	@endfor

	@isset($edit)
		<script>
			$(window).load(function () {
				var color = $('select.color-value').val();
				$('input.color-value').val(color);
                $('select.select2.categories').select2();

				var li = $('li.select2-selection__choice').first();
				for (var i = 0; i < color.length; ++i) {
					li.css({background: color[i]});
					li = li.next();
				}
			});
		</script>
	@endisset
@endsection