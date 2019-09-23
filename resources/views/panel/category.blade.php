@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		// Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',			
		//alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
		// Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
	<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach

	<style>
	.group-card {
		height: 150px;
		overflow: hidden;
	}
	.col-md-3 {
		float: right;
	}
	.delete-item {
		background: none;
		border: none;
		color: #181818;
	}
	img {
		width: 100%;
	}
	</style>
@endsection
	
@section('content')
	<div class="container">

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">
					@isset($category) ویرایش گروه {{$category->title}} @else ثبت گروه جدید @endisset
				</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">
						<span>@isset($category) ویرایش گروه {{$category->title}} @else ثبت گروه جدید @endisset</span>
					</li>
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
								<form action="@isset($category) {{ route('category.update', ['category' => $category->id]) }} @else {{ route('category.store') }} @endisset" method="POST" enctype="multipart/form-data">
									<h6 class="txt-dark flex flex-middle capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>مشخصات گروه</h6>
									<hr class="light-grey-hr"/>
									
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
										<div class="col-md-9">
											<div class="@isset($category) col-md-12 @else col-md-6 @endisset">
												<div class="form-group">
													<label class="control-label mb-10">نام گروه</label>
													<div class="input-group">
														<input type="text" name="title" id="firstName" @isset($category) value="{{$category->title}}" @else value="{{old('title')}}" @endisset class="form-control" placeholder="مثلا : تلفن همراه">
														<div class="input-group-addon"><i class="ti-text"></i></div>
													</div>
												</div>
											</div>
	
											@if(!isset($category))
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">گروه مادر</label>
													<div class="input-group">
														<select name="parent" class="form-control select2 categories">
															@if (isset($category))
															<option value="{{ $category->id }}">زیر مجموعه گروه {{ $category->title }}</option>
															@else
															<option value="">ثبت به عنوان گروه اصلی</option>
															@endif

															@foreach ($categories_new as $item)
															<option value="{{ $item->id}}">@if($item->parent==NULL)-----@endif{{$item->title}}@if($item->parent==NULL)-----@endif</option>
															@endforeach
														</select>
														<div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
													</div>
												</div>
											</div>
											@endif
											<!--/span-->
											
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label mb-10">توضیح کوتاه</label>
													<div class="input-group">
														<input type="text" name="description" id="firstName" 
															@isset($category) value="{{$category->description}}" @else value="{{old('description')}}" @endisset class="form-control" 
																	@if(isset($category) && empty($category->description))
																	placeholder="هیچ توضیحی برای گروه '{{$category->title}}' ثبت نشده است !"
																	@else 
																	placeholder="یک توضیح یک خطی درباره گروه"
																	@endif 
																>
														
														<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<input type="file" name="icon" id="category_icon" class="dropify" data-show-remove="false" @isset($category) data-default-file="{{ $category->icon }}" @endisset />
										</div>
										
										<div class="col-md-12">
											<label class="control-label mb-10">بنر گروه</label>
											<input type="file" name="banner" id="category_banner" class="dropify" data-show-remove="false" @isset($category) data-default-file="{{ $category->banner }}" @endisset />
										</div>
									</div>

									<hr class="light-grey-hr"/>
									
									<div class="form-actions">
										<button class="btn @isset($category) btn-warning @else btn-primary @endisset btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i>
											<span>@isset($category) ویرایش گروه @else ثبت گروه @endisset</span>
										</button>
										<div class="clearfix"></div>
									</div>

									@csrf
									
									@isset($category) @method('put') @endisset
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Row -->

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">لیست گروه ها</h5>
			</div>

			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					@isset($breadcrumb)
						@if (!empty($breadcrumb[0]))
							@foreach ($breadcrumb as $item)
								<li>
									<a href="/panel/category/{{ $item->id }}">
										{{ $item->title }}
									</a>
								</li>
							@endforeach
						@endif
					@endisset
					<li><a href="/panel/category/">دسته های اصلی</a></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->
		<div class="row">
			@empty($categories->first())
				<div class="alert alert-warning alert-dismissable">
					<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
					@if (isset($category))
						<p class="pull-right">هیچ زیر مجموعه ای برای گروه "{{ $category->title }}" ثبت نشده است !</p>
					@else
						<p class="pull-right">هیچ گروهی تاکنون ثبت نشده است !</p>
					@endif
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="clearfix"></div>
				</div>
			@endempty

			<?php $colors = ['danger', 'warning', 'info', 'primary', 'success']; $i = $x = 0; ?>

			@foreach ($categories as $item)
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php if ($x == 5) { $x = 0; } ?>
					<div class="panel panel-{{ $colors[$x] }} card-view panel-refresh">
						<div class="refresh-container">
							<div class="la-anim-1"></div>
						</div>
						<div class="panel-heading">
							<div class="pull-right">
								<a @if ( !isset($category) ) href="/panel/category/{{ $item->id }}" @endif>
									<h6 class="panel-title txt-light">{{ $item->title }}</h6>
								</a>
							</div>
							<div class="pull-left">
								<a class="pull-left inline-block mr-15" data-toggle="collapse" href="#collapse_<?=$i?>" aria-expanded="true">
									<i class="zmdi zmdi-chevron-down"></i>
									<i class="zmdi zmdi-chevron-up"></i>
								</a>

								<form action="{{ route('category.destroy', ['category' => $item->id]) }}" method="POST" class="pull-left inline-block mr-15">
									<a href="{{ route('category.edit', ['category' => $item->id]) }}">
										<i class="zmdi zmdi-edit"></i>
									</a>
									<button type="submit" itemid="{{ $item->id }}" class="delete-item">
										<i class="zmdi zmdi-close"></i></i>
									</button>
									
									@method('delete')
									@csrf
								</form>
							</div>
							<div class="clearfix"></div>
						</div>
						<div  id="collapse_<?=$i?>" class="panel-wrapper collapse in group-card">
							<div  class="panel-body">
								@if ($item->icon)
									<div class="col-md-6">
										<img src="{{ $item->icon }}" alt="Category icon">
									</div>
								@endif
								<div class="col-md-6">
									@empty($item->description)
										<div class="alert alert-warning alert-dismissable">
											<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
											<p class="pull-right">توضیحی ثبت نشده است !</p>
											<div class="clearfix"></div>
										</div>
									@endempty
									<p>{{ $item->description}}</p>
								</div>
							</div>
						</div>
					</div>
				</div>				
				<?php ++$i; ++$x ?>				
			@endforeach

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
		// Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
		// Init JavaScript
		'dist/js/init.js',
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach
	
	<script>
		$('.dropify').dropify();
		$('select.select2.categories').select2();

		$('.delete-item').on('click',function(){
			var title = $(this).parent().parent().find('h6').text();
			var id = $(this).attr('group');
			var form = $(this).parent();

			swal({   
				title: "مطمین هستید ؟",   
				text: "برای پاک کردن گروه " + title + " مطمین هستید ؟",   
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
					swal("لغو شد", "هیچ گروهی حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection