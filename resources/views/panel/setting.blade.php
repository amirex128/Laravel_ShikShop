@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		//  Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',
		// Custom CSS
		'dist/css/style.css'
	]; ?>
	
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
	<div class="container">
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
								<form action="/panel/setting/info" enctype="multipart/form-data" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="fa fa-info font-20 txt-grey ml-10" aria-hidden="true"></i>تغییر اطلاعات کلی</h6>
									<hr class="light-grey-hr"/>
									
									
									<div class="panel-body">
										<div class="row">
											
											<div class="col-md-8">
												<div class="form-wrap">
													<div class="row mb-10">
														<div class="col-md-8">
															<label class="control-label mb-10" for="exampleInputEmail_4">عنوان فروشگاه</label>
															<div class="input-group">
																<input type="text" value="{{$options['site_name']}}" name="site_name" class="form-control" id="exampleInputEmail_4" placeholder="نام فروشگاه شما">
																<div class="input-group-addon"><i class="fa fa-header" aria-hidden="true"></i></div>
															</div>
														</div>
														
														<div class="col-md-4">
															<label class="control-label mb-10" for="exampleInputEmail_5">شماره تلفن</label>
															<div class="input-group">
																<input type="text" value="{{$options['shop_phone']}}" name="phone" class="form-control" id="exampleInputEmail_5" placeholder="برای مثال : 09123456789">
																<div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="description">درباره فروشگاه</label>
														<div class="input-group">
															<textarea class="form-control" id="description" name="description" style="resize:none;" placeholder="یک توضیح یک خطی کوتاه درباره فروشگاه و کسب و کار شما" rows="2">{{$options['site_description']}}</textarea>
															<div class="input-group-addon"><i class="fa fa-align-right" aria-hidden="true"></i></div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="exampleInputEmail_2">آدرس فروشگاه شما</label>
														<div class="input-group">
															<input type="text" value="{{$options['shop_address']}}" name="address" class="form-control" id="exampleInputEmail_2" placeholder="آدرس فروشگاه شما که به مشتریان و کاربران نمایش داده میشود">
															<div class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="term_warranty">شرایط گارانتی</label>
														<div class="input-group">
														
															<textarea  style="resize:none;"
															
															           name="term_warranty[0]" class="form-control" id="term_warranty" placeholder="شرایط گارانتی شما...">{{json_decode($term_warranty->value)[0]}}</textarea>
															<div class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="follow_orders">بخش اول پیگیری سفارشات</label>
														<div class="input-group">
															<textarea style="resize:none;"
															          name="follow_orders[0]"
															          class="form-control" id="follow_orders" placeholder="بخش اول پیگیری سفارشات شما...">{{json_decode($follow_orders->value)[0]}}</textarea>
															<div class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="follow_orders">بخش دوم پیگیری سفارشات</label>
														<div class="input-group">
															<textarea name="follow_orders[1]"
															          class="form-control" id="follow_orders" placeholder="بخش دوم پیگیری سفارشات شما..." style="resize:none;" >{{json_decode($follow_orders->value)[1]}}</textarea>
															<div class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="follow_orders">لینک پیگیری سفارشات</label>
														<div class="input-group">
															<input type="text" name="follow_orders[2]"
															       value="{{json_decode($follow_orders->value)[2]}}"
															       class="form-control" id="follow_orders" placeholder="شرایط گارانتی شما...">
															<div class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<label class="control-label mb-10">تصویر شرایط گارانتی</label>
												<div class="mt-10 mb-10">
													<input type="file" data-default-file="/{{json_decode($term_warranty->value)[1]}}" name="term_warranty[1]" id="input-file-now" class="dropify1" />
												</div>
											</div>
											<div class="col-md-2">
												<label class="control-label mb-10"> تصویر پیگیری سفارشات</label>
												<div class="mt-10 mb-10">
													<input type="file" data-default-file="/{{json_decode($follow_orders->value)[3]}}" name="follow_orders[3]" id="input-file-now" class="dropify2" />
												</div>
											</div>
											<div class="col-md-2">
												<label class="control-label mb-10">لوگوی فروشگاه</label>
												<div class="mt-10 mb-10">
													<input type="file" data-default-file="/logo/{{$options['site_logo']}}" name="logo" id="input-file-now" class="dropify3" />
												</div>
											</div>
											
{{--											<div class="col-md-2">--}}
{{--												<label class="control-label mb-10">واترمارک تصاویر محصول</label>--}}
{{--												<div class="mt-10 mb-10">--}}
{{--													<input type="file" data-default-file="/logo/{{$options['watermark']}}" name="watermark" id="input-file-now" class="dropify4" />--}}
{{--												</div>--}}
{{--											</div>--}}
										</div>
									</div>
									
									<div class="form-actions">
										<button class="btn btn-primary btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره اطلاعات کلی</span></button>
										<div class="clearfix"></div>
									</div>
									@csrf
								</form>
							</div>
							
							<div class="form-wrap">
								<form action="/panel/setting/social_link" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="fa fa-link font-20 txt-grey ml-10" aria-hidden="true"></i>لینک شبکه های اجتماعی</h6>
									<hr class="light-grey-hr"/>
									
									
									<div class="panel-body">
										<div class="form-wrap">
											<div class="row mb-10">
												<div class="col-md-6">
													<label class="control-label mb-10" for="exampleInputEmail_5">اینستاگرام</label>
													<div class="input-group">
														<input type="text" dir="ltr" value="{{$options['social_link']->instagram}}" name="instagram" class="form-control" id="exampleInputEmail_5" placeholder="لینک صفحه شما در شبکه اجتماعی اینستاگرام">
														<div class="input-group-addon"><i class="fa fa-instagram" aria-hidden="true"></i></div>
													</div>
												</div>
												<div class="col-md-6">
													<label class="control-label mb-10" for="exampleInputEmail_4">تلگرام</label>
													<div class="input-group">
														<input type="text" dir="ltr" value="{{$options['social_link']->telegram}}" name="telegram" class="form-control" id="exampleInputEmail_4" placeholder="لینک صفحه شما در شبکه اجتماعی تلگرام">
														<div class="input-group-addon"><i class="fa fa-telegram" aria-hidden="true"></i></div>
													</div>
												</div>
											</div>
											
											<div class="row mb-10">
												<div class="col-md-6">
													<label class="control-label mb-10" for="exampleInputEmail_5">توییتر</label>
													<div class="input-group">
														<input type="text" dir="ltr" value="{{$options['social_link']->twitter}}" name="twitter" class="form-control" id="exampleInputEmail_5" placeholder="لینک صفحه شما در شبکه اجتماعی توییتر">
														<div class="input-group-addon"><i class="fa fa-twitter" aria-hidden="true"></i></div>
													</div>
												</div>
												<div class="col-md-6">
													<label class="control-label mb-10" for="exampleInputEmail_4">فیسبوک</label>
													<div class="input-group">
														<input type="text" dir="ltr" value="{{$options['social_link']->facebook}}" name="facebook" class="form-control" id="exampleInputEmail_4" placeholder="لینک صفحه شما در شبکه اجتماعی فیسبوک">
														<div class="input-group-addon"><i class="fa fa-facebook" aria-hidden="true"></i></div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-actions">
										<button class="btn btn-succuess btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره لینک ها</span></button>
										<div class="clearfix"></div>
									</div>
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
		// Bootstrap Daterangepicker JavaScript
		'vendors/bower_components/dropify/dist/js/dropify.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Select2 JavaScript
		'vendors/bower_components/select2/dist/js/select2.full.min.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Bootstrap Tagsinput JavaScript
		'vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Init JavaScript
		'dist/js/init.js',
		// Setting page
		'dist/js/setting.js'
	]; ?>
	
	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach
	
	<script> $('.dropify1').dropify(); </script>
	<script> $('.dropify2').dropify(); </script>
	<script> $('.dropify3').dropify(); </script>
	<script> $('.dropify4').dropify(); </script>
	
	@isset($edit)
		<script>
			$(window).load(function () {
				var color = $('select.color-value').val();
				$('input.color-value').val(color);
				
				var li = $('li.select2-selection__choice').first();
				for (var i = 0; i < color.length; ++i) {
					li.css({background: color[i]});
					li = li.next();
				}
			});
		</script>
	@endisset
@endsection
