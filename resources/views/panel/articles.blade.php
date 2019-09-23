@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
		//  Custom Fonts
		'dist/css/font-awesome.min.css',
		//  Calendar CSS
		'vendors/bower_components/fullcalendar/dist/fullcalendar.css"',
		//  Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach

	<style>
	.product-card {
		float: right;
	}

	.product-card .info {
	    height: 130px;
		overflow: auto;
	}

	.product-card .label {
		position: absolute;
		bottom: 10px;
		left: 0px;
		box-shadow: 0px 0px 10px -3px #000;
		padding: 5px 10px !important;
	}

	.product-card .btn.btn-circle {
		height: 20px;
		width: 20px;
	}

	.product-card .btn.btn-circle i {
		font-size: 10px !important;
	}

	.product-pic {
		height: 250px;
	}
	.label.flag {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		padding: 6px 10px;
		font-size: 20px;
		background: #9797979e;
		box-shadow: 0px 0px 10px #000;
		border-radius: 5px;
		height: 32px;
	}
	.gray {
		-webkit-filter: grayscale(100%);
		filter: grayscale(100%);
	}
	.shadow {
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0px;
		left: 0px;
		background: #00000085;
	}
	.photo .options {
		z-index: 100;
	}
	.pagination {
		position: relative;
		top: 15px;
		width: 100%;
		display: flex;
		justify-content: center;
	}
	.delete-item {
		background: none;
		border: none;
	}
	</style>
@endsection
	
@section('content')
	<div class="container">

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">مقالات</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="index.html">داشبورد</a></li>
					<li><a href="#"><span>فروشگاه</span></a></li>
					<li class="active"><span>مقالات</span></li>
				</ol>
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
							<h6 class="panel-title txt-dark">جستجو در مقالات</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div  class="panel-wrapper collapse in">
						<div  class="panel-body">
							<div class="form-group">
								<div class="input-group">
									<input type="text" name="article_title" onkeyup="this.nextElementSibling.href = '/panel/article/search/'+this.value" @isset($query) value="{{$query}}" @endisset id="firstName" class="form-control" placeholder="مثلا : تلفن همراه">
									<a href="/panel/article/search/" class="input-group-addon"><i class="ti-search"></i></a>
								</div>
							</div>
						</div>
					</div>

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
				</div>
			</div>

		</div>
		<!-- Group Row -->

		<div class="seprator-block"></div>
		
		<!-- Product Row One -->
		<div class="row">
			@empty($articles[0])
			<div class="alert alert-warning alert-dismissable">
				<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
				<p class="pull-right">هیچ محصولی یافت نشد !</p>
				<div class="clearfix"></div>
			</div>
			@else
				@foreach ($articles as $item)
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 product-card">
					<div class="panel panel-default card-view pa-0">
						<div class="panel-wrapper collapse in">
							<div class="panel-body pa-0">
								<article class="col-item">
									<div class="photo">
										<div class="options">
											<form action="{{ route('article.destroy', ['article' => $item->id]) }}" method="POST">
												<a href="{{ route('article.edit', ['article' => $item->id]) }}" class="font-18 txt-grey mr-10 pull-left"><i class="icon ti-pencil"></i></a>
												<button type="submit" itemid="{{ $item->id }}" class="font-18 txt-grey pull-left delete-item"><i class="icon ti-close"></i></button>
												
												@method('delete')
												@csrf
											</form>	
										</div>
										
										<a href="javascript:void(0);">
											<div class="product-pic img-responsive"
												{{-- style="background: url('{{ asset('uploads/'.$product->photo) }}') center center; --}}
												style="background: url('{{ $item->image }}') center center;
													background-size: cover;">
											</div>
										</a>
									</div>
									<div class="info">
										<h5>{{$item->title}}</h5>
										<span class="head-font block txt-orange-light-1 font-16">{{$item->description}}</span>
									</div>
								</article>
							</div>
						</div>	
					</div>	
				</div>
				@endforeach	
			@endempty

			{{ $articles->links() }}
		</div>	
		<!-- /Product Row Four -->
		
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
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
		'dist/js/sweetalert-data.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Init JavaScript
		'dist/js/init.js',
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach

	<script>
		$('.delete-item').on('click',function(){
			var title = $(this).parent().parent().next().find('h5').text();
			var id = $(this).attr('product');
			var form = $(this).parent();

			swal({   
				title: "مطمین هستید ؟",   
				text: "برای پاک کردن مقاله " + title + " مطمین هستید ؟",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#f83f37",   
				confirmButtonText: "بله",   
				cancelButtonText: "خیر",   
				closeOnConfirm: false,   
				closeOnCancel: false 
			}, function(isConfirm){   
				if (isConfirm) {
					form.submit();
				} else {     
					swal("لغو شد", "هیچ مقاله ای حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection