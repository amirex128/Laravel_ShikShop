@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		//  Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',
		// Bootstrap Dropzone CSS
		'/vendors/bower_components/dropzone/dist/dropzone.css',
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
			</div>


			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->

		<!-- Group Row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-right">
							<h6 class="panel-title txt-dark">تمام تامین کننده ها</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">


<div class="container">
	@if($status == 1)
		<form action="/panel/provider" method="post" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-12">
					<label for="title">نام تامین کننده :</label>
					<input type="text" id="title" name="title" class="form-control">
				</div>
				<div class="col-12 my-3">
					<label for="description">توضیحات تامین کننده :</label>
					<input type="text" id="description" name="description" class="form-control">
				</div>
				<div class="col-12">
					<div class="mt-30">
						<input type="file" name="image" id="input-file-now" class="dropify" @isset($article) data-default-file="{{ $article->image }}" @endisset />
					</div>
				</div>
				<div class="col-12">

					<button class="btn btn-danger btn-block m-3"> ذخیره</button>
				</div>
			</div>

		</form>

	@else

		<form action="/panel/provider/{{$Provider->id}}" method="post" enctype="multipart/form-data">
			@csrf
			@method('put')
			<div class="row">
				<div class="col-12">
					<label for="title">نام تامین کننده :</label>
					<input type="text" id="title" name="title" value="{{$Provider->title}}" class="form-control">
				</div>
				<div class="col-12 my-3">
					<label for="description">توضیحات تامین کننده :</label>
					<input type="text" id="description" value="{{$Provider->description}}" name="description" class="form-control">
				</div>
				<div class="col-12">
					<div class="mt-30">
						<input type="file" name="image"  id="input-file-now" class="dropify"  data-default-file="{{ $Provider->banner }}"  />
					</div>
				</div>
				<div class="col-12">

					<button class="btn btn-danger btn-block m-3"> ذخیره</button>
				</div>
			</div>

		</form>

	@endif

</div>

						</div>
					</div>
				</div>

			</div>
		</div>

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
		'dist/js/group_ajax.js'
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>	
	@endforeach

	<script>
		@isset($article)
			$(window).load(function () {
				var color = $('select.color-value').val();
				$('input.color-value').val(color);
				
				var li = $('li.select2-selection__choice').first();
				for (var i = 0; i < color.length; ++i) {
					li.css({background: color[i]});
					li = li.next();
				}
			});
		@endisset

		$("#dropzone").dropzone({ url: "/file/post" });
	</script>
@endsection