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
				<h5 class="txt-dark">@isset($article) ویرایش مقاله @else ثبت مقاله @endisset</h5>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>@isset($article) ویرایش مقاله @else ثبت مقاله @endisset</span></li>
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
								<form action="@isset($article) {{ route('article.update', ['article' => $article->id]) }} @else {{ route('article.store') }} @endisset" enctype="multipart/form-data" method="POST">
									
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

									<div class="row">
										<div class="col-md-12">
											<div class="col-md-9">
												<div class="col-md-12">
													<div class="form-group @if( $errors->has('title') ) has-error @endif">
														<label class="control-label mb-10">عنوان مقاله</label>
														<div class="input-group">
															<input type="text" name="title" @if(isset($article) && !empty($article->title)) value="{{$article->title}}" @else value="{{old('title')}}" @endif id="title" class="form-control" placeholder="عنوان مقاله مورد نظر">
															<div class="input-group-addon"><i class="ti-text"></i></div>
														</div>
														@if( $errors->has('title') )
															<span class="help-block">{{ $errors->first('title') }}</span>
														@endif
													</div>
												</div>
	
												<div class="col-md-12">
													<div class="form-group @if( $errors->has('description') ) has-error @endif">
														<label class="control-label mb-10">توضیح کوتاه</label>
														<div class="input-group">
															<textarea class="form-control" id="description" name="description" style="resize:none;" placeholder="یک توضیح یک خطی درباره مقاله" rows="5">@isset($article){{$article->description}}@else{{old('description')}}@endisset</textarea>
															<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
														</div>
														@if( $errors->has('description') )
															<span class="help-block">{{ $errors->first('description') }}</span>
														@endif
													</div>
												</div>
											</div>

											<div class="col-md-3">
												<div class="mt-30">
													<input type="file" name="image" id="input-file-now" class="dropify" @isset($article) data-default-file="{{ $article->image }}" @endisset />
												</div>	
											</div>
										</div>


										<div class="col-md-12">
											<div class="form-group @if( $errors->has('body') ) has-error @endif">
												<label for="body" style="margin-bottom: 15px">متن مقاله</label>
												<textarea name="body" id="body" class="form-control">@isset($article) {{$article->body}} @else {{old('body')}} @endisset</textarea>
												@if( $errors->has('body') )
													<span class="help-block">{{ $errors->first('body') }}</span>
												@endif
											</div>
											<script>
												CKEDITOR.replace( 'body', {
													language: 'fa'
												});
											</script>
										</div>
									</div>
									
									<div class="form-actions">
										<button class="btn btn-orange btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره</span></button>
										<a href="/panel/products" class="btn btn-default pull-left">لغو</a>
										<div class="clearfix"></div>
									</div>

									@isset($article) @method('put') @endisset
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