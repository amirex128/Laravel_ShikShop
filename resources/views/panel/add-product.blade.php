@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		// bootstrap-select CSS
		'vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css',
		//  Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',
		// Bootstrap Dropzone CSS
		'/vendors/bower_components/dropzone/dist/dropzone.css',
		// Bootstrap Datetimepicker CSS
		'vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
		// Custom CSS
		'dist/css/style.css'
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach
	
	<script src="/ckeditor/ckeditor.js"></script>

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
		
		
    </style>
@endsection

@section('content')
	<div class="container">
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">@isset($product) ویرایش محصول @else ثبت محصول @endisset</h5>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>@isset($product) ویرایش محصول @else ثبت محصول @endisset</span></li>
					<li>فروشگاه</li>
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
								<form action="@isset($product) {{ route('product.update', ['product' => $product->id]) }} @else {{ route('product.store') }} @endisset" enctype="multipart/form-data" method="POST" id="product_form">
									
									@if ( $errors->all() || session()->has('message') )
										<div class="panel-body">
											@foreach ($errors -> all() as $message)
												<div class="alert alert-danger alert-dismissable">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													{{ $message }}
												</div>
											@endforeach
								
											@if(session()->has('message'))
												<div class="alert alert-success alert-dismissable">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													{{ session()->get('message') }}
												</div>
											@endif
										</div>
									@endif
									
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>درباره محصول</h6>
									<hr class="light-grey-hr"/>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group @if( $errors->has('name') ) has-error @endif">
												<label class="control-label mb-10">نام محصول</label>
												<div class="input-group">
													<input type="text" name="name" @isset($product) value="{{$product->name}}" @else value="{{old('name')}}" @endisset id="firstName" class="form-control" placeholder="مثلا : 'گوشی موبایل سامسونگGalaxy S7'">
													<div class="input-group-addon"><i class="ti-text"></i></div>
												</div>
												@if( $errors->has('name') )
													<span class="help-block">{{ $errors->first('name') }}</span>
												@endif
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group @if( $errors->has('parent') ) has-error @endif">
												<label class="control-label mb-10">گروه</label>
												<div class="input-group">
													<select name="categories[]" data-placeholder="گروه های محصول مورد نظر را انتخاب کنید" class="form-control select2 categories" multiple="multiple">
														@php $categories = [] @endphp
														@isset($product->categories)
															@php $categories = $product->categories->pluck('id')->toArray() @endphp
														@endisset

														@foreach ($groups as $group)

																@foreach ($group->childs as $item)
																	<option value="{{ $item['id'] }}" @if( in_array( $item['id'], $categories) ) selected="selected" @endif>{{ $item['title'] }}</option>
																@endforeach
														@endforeach
													</select>
													<div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
												</div>
												@if( $errors->has('parent') )
													<span class="help-block">{{ $errors->first('parent') }}</span>
												@endif

											</div>
										</div>
										<!--/span-->
										
										<div class="col-md-12">
											<div class="form-group @if( $errors->has('link') ) has-error @endif">
												<label class="control-label mb-10">لینک خرید</label>
												<div class="input-group">
													<input type="text" dir="ltr" name="link" @isset($product) value="{{$product->link}}" @else value="{{old('link')}}" @endisset id="link" class="form-control" placeholder="http://example.com/path/to/product">
													<div class="input-group-addon"><i class="fa fa-link"></i></div>
												</div>
												@if( $errors->has('link') )
													<span class="help-block">{{ $errors->first('link') }}</span>
												@endif
											</div>
										</div>
										<!--/span-->
									</div>

									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey fa fa-tachometer ml-10"></i>ویژگی ها</h6>
									<hr class="light-grey-hr"/>
									<!-- Row -->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group @if( $errors->has('brand') ) has-error @endif">
												<label class="control-label mb-10">برند</label>
												<div class="input-group">
													<select name="brand_id" class="form-control select2 categories">
														<option value="">بدون برند</option>
														@foreach ($brands as $item)
														<option value="{{ $item->id }}"
															@if(isset($product->brand) && $product->brand->id == $item->id) selected="selected" @endif>
															{{ $item->title }}
														</option>
														@endforeach
													</select>
													<div class="input-group-addon"><i class="ti-apple"></i></div>
												</div>
												@if( $errors->has('brand') )
													<span class="help-block">{{ $errors->first('brand') }}</span>
												@endif
												
											</div>
										</div>
										<div class="col-md-6">
												<label class="control-label mb-10">تامین کننده</label>
												<div class="input-group">
													<select name="provider_id" class="form-control select2 categories">
														<option value="">بدون تامین کننده</option>
														@foreach ($provider as $item)
															<option value="{{ $item->id }}"
																	@if(isset($product->provider ) && $product->provider->id == $item->id) selected="selected" @endif>
																{{ $item->title }}
															</option>
														@endforeach
													</select>
													<div class="input-group-addon"><i class="ti-apple"></i></div>
												</div>



										</div>
										<div class="col-md-12">
											<div class="form-group @if( $errors->has('size') ) has-error @endif">
												<label class="control-label mb-10">سایز</label>
												<div class="input-group">
													<select name="size_id" class="form-control select2 categories">
														<option value="">بدون سایز</option>
														@foreach ($sizes as $item)
														<option value="{{ $item->id }}"
															@if(isset($product->design) && $product->size->id == $item->id) selected="selected" @endif>
															{{ $item->size }}
														</option>
														@endforeach
													</select>
													<div class="input-group-addon"><i class="fa fa-percent"></i></div>
												</div>
												@if( $errors->has('size') )
													<span class="help-block">{{ $errors->first('size') }}</span>
												@endif
												
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group @if( $errors->has('design') ) has-error @endif">
												<label class="control-label mb-10">طرح</label>
												<div class="input-group">
													<select name="design_id" class="form-control select2 categories">
														<option value="">بدون طرح</option>
														@foreach ($designs as $item)
														<option value="{{ $item->id }}"
															@if(isset($product->design) && $product->design->id == $item->id) selected="selected" @endif>
															{{ $item->title }}
														</option>
														@endforeach
													</select>
													<div class="input-group-addon"><i class="fa fa-tachometer"></i></div>
												</div>
												@if( $errors->has('design') )
													<span class="help-block">{{ $errors->first('design') }}</span>
												@endif
												
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group @if( $errors->has('color') ) has-error @endif">
												<label class="control-label mb-10">رنگ</label>
												<div class="input-group">
													<select multiple name="colors[]" class="form-control select2 categories">
														<option value="">بدون رنگ</option>
														@foreach ($colors as $item)
															 @if (isset($thatProduct))
																<option {{in_array($item->id,$thatProduct->color->pluck("id")->toArray())?"selected":""}} value="{{ $item->id }}">
																@else
																<option value="{{ $item->id }}">
																
																
																@endif
																
															{{ $item->name }}
														</option>
														@endforeach
													</select>
													<div class="input-group-addon"><i class="fa fa-paint-brush"></i></div>
												</div>
						
											</div>
										</div>
									</div>
									<!--/row-->

									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey fa fa-usd ml-10"></i>قیمت و وضعیت</h6>
									<hr class="light-grey-hr"/>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group @if( $errors->has('price') ) has-error @endif">
												<label class="control-label mb-10">قیمت</label>
												<div class="input-group">
													<input type="number" min="0" @isset($product) value="{{$product->price}}" @else value="{{old("price")}}"  @endisset name="price" class="form-control" id="exampleInputuname" placeholder="مثلا : 1550000">
													<div class="input-group-addon"><i class="ti-money"></i></div>
												</div>
												@if( $errors->has('price') )
													<span class="help-block">{{ $errors->first('price') }}</span>
												@endif
											</div>
										</div>
										<!--/span-->

										<div class="col-md-6">
											<div class="form-group @if( $errors->has('offer') ) has-error @endif">
												<label class="control-label mb-10">قیمت با تخفیف</label>
												<div class="input-group">
													<input type="number" name="offer" @isset($product) value="{{$product->offer}}" @else value="{{old("offer")}}" @endisset class="form-control" id="exampleInputuname_1" placeholder="قیمت کالا با احتساب تخفیف ، برای مثال : 120,000" min="0" />
													<div class="input-group-addon"><i class="ti-cut"></i></div>
												</div>
												@if( $errors->has('offer') )
													<span class="help-block">{{ $errors->first('offer') }}</span>
												@endif
											</div>
										</div>
									</div>
								
									<div class="row">
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group @if( $errors->has('status') ) has-error @endif">
												<label class="control-label mb-10">وضعیت</label>
												<div class="radio-list">
													<div class="radio-inline">
														<div class="radio radio-info">
															<input type="radio" @if(isset($product) && $product->status == 0) checked="checked" @elseif(old('status') == 0) checked @endif name="status" id="radio2" value="0">
															<label for="radio2">پیش نویس</label>
														</div>
													</div>
													<div class="radio-inline pl-0">
														<div class="radio radio-info">
															<input type="radio" @if(isset($product) && $product->status == 1) checked="checked" @elseif(old('status') == 1) checked @endif  @if(!isset($product)) checked="checked" @endisset name="status" id="radio1" value="1">
															<label for="radio1">ثبت محصول</label>
														</div>
													</div>
												</div>
											</div>
											@if( $errors->has('status') )
												<span class="help-block">{{ $errors->first('status') }}</span>
											@endif
										</div>

										<!--/span-->
										<div class="col-md-6">
											<div class="form-group @if( $errors->has('special') ) has-error @endif">
												<label class="control-label mb-10">محصول ویژه</label>
												<div class="radio-list">
													<div class="radio-inline">
														<div class="radio radio-info">
															<input type="radio" @if(isset($product) && $product->special == 0) checked="checked" @elseif(old('special') == 0) checked @endif name="special" id="special_0" value="0">
															<label for="special_0">محصول عادی</label>
														</div>
													</div>
													<div class="radio-inline pl-0">
														<div class="radio radio-info">
															<input type="radio" @if(isset($product) && $product->special == 1) checked="checked" @elseif(old('special') == 1) checked @endif  @if(!isset($product)) checked="checked" @endisset name="special" id="special_1" value="1">
															<label for="special_1">محصول ویژه</label>
														</div>
													</div>
												</div>
											</div>
											@if( $errors->has('status') )
												<span class="help-block">{{ $errors->first('status') }}</span>
											@endif
										</div>
									</div>
									
									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-comment-text ml-10"></i>توضیح محصول</h6>
									<hr class="light-grey-hr"/>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group @if( $errors->has('description') ) has-error @endif">
												<label for="description" style="margin-bottom: 15px">توضیحات محصول</label>
												<textarea name="description" id="description" class="form-control">@isset($product) {{$product->description}} @else {{old('description')}} @endisset</textarea>
												@if( $errors->has('description') )
													<span class="help-block">{{ $errors->first('description') }}</span>
												@endif
											</div>
											<script>
												CKEDITOR.replace( 'description', {
													language: 'fa'
												});
											</script>
										</div>
									</div>

									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey fa fa-table ml-10"></i>مشخصات فنی محصول</h6>
									<hr class="light-grey-hr"/>
									<div class="row spec-rows">
										@php $spec_row = 0 @endphp
										@isset( $product->specs)
											@foreach( $product->specs as $item )
												<div class="col-md-6">
													<div class="form-group">
														<div class="input-group">
															<input type="text" name="spec[{{ $spec_row }}][key]" value="{{ $item->key }}" class="form-control" id="exampleInputuname_1" placeholder="عنوان ویژگی محصول" />
															<div class="input-group-addon"><i class="ti-text"></i></div>
														</div>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<div class="input-group">
															<input type="text" name="spec[{{ $spec_row++ }}][value]" value="{{ $item->value }}" class="form-control" id="exampleInputuname_1" placeholder="مقدار ویژگی محصول" />
															<div class="input-group-addon"><i class="ti-info"></i></div>
														</div>
													</div>
												</div>
												<input type="hidden" name="spec[{{ $spec_row }}][id]" value="{{ $item->id }}" />
											@endforeach
										@endisset

										<div class="spec-row">
											<div class="col-md-6">
												<div class="form-group">
													<div class="input-group">
														<input type="text" name="spec[{{ $spec_row }}][key]" class="form-control" id="exampleInputuname_1" placeholder="عنوان ویژگی محصول" />
														<div class="input-group-addon"><i class="ti-text"></i></div>
													</div>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<div class="input-group">
														<input type="text" name="spec[{{ $spec_row++ }}][value]" class="form-control" id="exampleInputuname_1" placeholder="مقدار ویژگی محصول" />
														<div class="input-group-addon"><i class="ti-info"></i></div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<input type="button" value="افزودن ویژگی جدید +" class="btn btn-primary add-spec" />
										</div>
									</div>

									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey fa fa-picture-o ml-10"></i>گالری تصاویر</h6>
									<hr class="light-grey-hr"/>
									<div class="row">
										<div class="col-sm-12">
											<div class="panel panel-default border-panel card-view">
												<div class="panel-wrapper collapse in">
													<div class="panel-body">
														<div class="col-md-12 images-gallery">
															@isset($product)
																@foreach ($product->gallery as $item)
																	<div class="col-md-3 mt-20">
																		<input type="file" data-default-file="{{ $item }}" data-allowed-formats="square" filename="{{ $item }}" name="images[]" class="dropify exists" />
																	</div>
																@endforeach
																<input type="hidden" name="deleted_images" data-allowed-formats="square" value="[]" />
															@endisset
															<div class="col-md-3 mt-20">
																<input type="file"  name="images[]" id="input-file-now" data-allowed-formats="square" class="dropify" />
															</div>
														</div>
														<div class="col-md-12">
															<input type="button" style="margin-bottom:-120px" class="add-new-image btn btn-primary" value="تصویر جدید" />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="form-actions">
										<button class="btn btn-orange btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره</span></button>
										<a href="/panel/product" class="btn btn-default pull-left">لغو</a>
										<div class="clearfix"></div>
									</div>

									@isset($product) @method('put') @endisset
									@csrf
								</form>
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
		'vendors/bower_components/jquery/dist/jquery.min.js',
		// Bootstrap Core JavaScript
		'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js',
		'vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// Tinymce JavaScript
		'vendors/bower_components/tinymce/tinymce.min.js',
		// Tinymce Wysuhtml5 Init JavaScript
		'dist/js/tinymce-data.js',
		// Gallery JavaScript
        'dist/js/isotope.js',
        'dist/js/lightgallery-all.js',
        'dist/js/froogaloop2.min.js',
		'dist/js/gallery-data.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// Moment JavaScript
		'vendors/bower_components/moment/min/moment-with-locales.min.js',
		// Bootstrap Datetimepicker JavaScript
		'vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
		// Dropzone JavaScript
		'vendors/bower_components/dropzone/dist/dropzone.js',
		// Dropzone Init JavaScript
		'dist/js/dropzone-data.js',

		// Bootstrap Daterangepicker JavaScript
		'vendors/bower_components/dropify/dist/js/dropify.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Select2 JavaScript
		'vendors/bower_components/select2/dist/js/select2.full.min.js',
		// Bootstrap Select JavaScript
		'vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Bootstrap Tagsinput JavaScript
		'vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Init JavaScript
		'dist/js/init.js',
		// Init Add Product Page JavaScript
		'dist/js/init_add_product.js',
		// Get Groups by Ajax
		'dist/js/group_ajax.js',
		// JS Validation
		// 'vendor/jsvalidation/js/jsvalidation.js'
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach

    <script>
        var spec_row = [];

        spec_row[0] = '<div class="spec-row"><div class="col-md-6"><div class="form-group"><div class="input-group">';
        spec_row[0] += '<input type="text" name="spec[';

        spec_row[1] = '][key]" class="form-control" id="exampleInputuname_1" placeholder="عنوان ویژگی محصول" />';
        spec_row[1] += '<div class="input-group-addon"><i class="ti-text"></i></div></div></div></div><div class="col-md-6">';
        spec_row[1] += '<div class="form-group"><div class="input-group"><input type="text" name="spec[';            

        spec_row[2] = '][value]" class="form-control" id="exampleInputuname_1" placeholder="مقدار ویژگی محصول" />';
        spec_row[2] += '<div class="input-group-addon"><i class="ti-info"></i></div></div></div></div></div>';

        var row_counter = {{ $spec_row }};
        
        $('.add-spec').click(function () {
            $('.spec-rows').append( spec_row[0] + row_counter + spec_row[1] + row_counter + spec_row[2] );
            ++row_counter;
        });
	</script>
@endsection