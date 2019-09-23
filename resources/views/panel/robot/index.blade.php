@extends('panel.master.main')

@section('styles')
	<?php $styles = [
// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css' ,
//  Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css' ,
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
										 aria-hidden="true"></i>تنظیمات ربات</h6>
								<hr class="light-grey-hr"/>
								<div class="panel-body">
									<div class="row">

										<div class="col-12">
											<form  id="form-save" class="form-row" method="post" action="/panel/robot">
												@csrf
												<div id="form-section">
														<div class="form-group col-sm-6">
															<label for="category-destination">دسته بندی مبدا</label>
															<input name="origin" id="category-destination" type="text"
															       class="form-control">
														</div>

														<div class="form-group col-sm-6">
															<label for="category-destination">دسته بندی مقصد</label>
															<select name="destination" id="category-destination"
															        class="form-control">
																@foreach($categories as $category)
																	<option value="{{$category->id}}">{{$category->title}}</option>
																@endforeach
															</select>
														</div>
													</div>
												<div class="w-100"></div>
												<div class="col-12">
													<div class="row mt-25">
														<div class="col-sm-12 text-center">
															<button id="save" class="btn btn-info"> ذخیره
															</button>
														</div>
													</div>
												</div>
											</form>

										</div>

										<div class="w-100"></div>

										<div class="col-12">
											         <div class="container">
											<table class="table table-bordered mt-50">
											<thead>
											<tr>
												<th>شناسه</th>
												<th>دسته بندی مبدا</th>
												<th>دسته بندی مقصد</th>
												<th>تاریخ ایجاد</th>
												<th>عملیات</th>
											</tr>
											</thead>
												<tbody>


												@foreach ($robots as $robotTable)

													<tr>
														<td>{{$robotTable->id}}</td>
														<td>{{$robotTable->origin}}</td>
														<td>{{$robotTable->category->title}}</td>
														<td>{{$robotTable->created_at}}</td>
														<td class="text-center">

															<div class="btn-group" role="group"
															     aria-label="">
																<button onclick="document.getElementById('form-delete-{{$robotTable->id}}').submit()" id="delete{{$robotTable->id}}" type="button"
																        class="btn btn-danger">
																	حذف
																</button>
																<button onclick="window.location.href='robot/{{$robotTable->id}}/edit'" id="edit{{$robotTable->id}}" type="button"
																        class="btn btn-primary">
																	ویرایش
																</button>
															</div>

															<form id="form-delete-{{$robotTable->id}}" method="post" action="robot/{{$robotTable->id}} ">@method('delete') @csrf</form>

														</td>
													</tr>

												@endforeach

												</tbody>
											</table>
												      </div>
										</div>

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
		'vendors/bower_components/select2/dist/js/select2.full.min.js' ,
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

	<script src="{{asset('/dist/jquery-3.3.1.min.js')}}"></script>






	<script>

		$(function () {



			$('#add').click(function () {
				var a=$('#first').html()
				$('#form-section').append(a);
			});
			$('#delete').click(function () {
				$('#form-section > :last-child').remove();

			})
		})

	</script>



















	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach


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
