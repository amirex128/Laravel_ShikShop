@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// Data table CSS
		'vendors/bower_components/datatables/media/css/jquery.dataTables.min.css',
		//alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
		// Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
	<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach
@endsection
	
@section('content')
	<div class="container">

		@isset($user)
			<!-- Title -->
			<div class="row heading-bg">
				<!-- Breadcrumb -->
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<h5 class="txt-dark">ویرایش کاربر</h5>
				</div>
			
				<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					<ol class="breadcrumb">
						<li class="active"><span>ویرایش کاربر {{ $user->full_name }}</span></li>
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
									<form action="{{ route('user.update', $user->id) }}" method="POST">
										<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>مشخصات کاربر</h6>
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
											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label mb-10" for="title">نام</label>
													<div class="input-group">
														<input type="text" name="first_name" id="first_name" value="{{$user->first_name}}" class="form-control" />
														<div class="input-group-addon"><i class="ti-text"></i></div>
													</div>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label mb-10" for="last_name">نام خانوادگی</label>
													<div class="input-group">
														<input type="text" name="last_name" id="last_name" value="{{$user->last_name}}" class="form-control" />
														<div class="input-group-addon"><i class="ti-text"></i></div>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10" for="phone">شماره تلفن</label>
													<div class="input-group">
														<input type="text" name="phone" id="phone" value="{{$user->phone}}" class="form-control" />
														<div class="input-group-addon"><i class="ti-info"></i></div>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10" for="email">آدرس ایمیل</label>
													<div class="input-group">
														<input type="email" name="email" id="email" value="{{$user->email}}" class="form-control" />
														<div class="input-group-addon"><i class="ti-info"></i></div>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10" for="mac_address">مک آدرس</label>
													<div class="input-group">
														<input type="text" name="mac_address" id="mac_address" value="{{$user->mac_address}}" class="form-control" />
														<div class="input-group-addon"><i class="ti-info"></i></div>
													</div>
												</div>
											</div>
										</div>

										<hr class="light-grey-hr"/>
										
										<div class="form-actions">
											<button class="btn @isset($user) btn-warning @else btn-primary @endisset btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i>
												<span>@isset($user) ویرایش @else ثبت @endisset کاربر</span>
											</button>
											<div class="clearfix"></div>
										</div>

										@csrf

										@isset($user) @method('put') @endisset
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Row -->
		@endisset

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">لیست کاربر ها</h5>
			</div>

			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"></div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->	
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default border-panel card-view">
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="datable_2" class="table table-hover table-bordered display mb-30" >
										<thead>
											<tr>
												<th>#</th>
												<th>نام کاربر</th>
												<th>شماره تلفن</th>
												<th>آدرس ایمیل</th>
												<th>مک‌ آدرس</th>
												<th>تاریخ ثبت</th>
												<th>تاریخ آخرین ویرایش</th>
												<th>عملیات</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>نام کاربر</th>
												<th>شماره تلفن</th>
												<th>آدرس ایمیل</th>
												<th>مک‌ آدرس</th>
												<th>تاریخ ثبت</th>
												<th>تاریخ آخرین ویرایش</th>
												<th>عملیات</th>
											</tr>
										</tfoot>
										<tbody>
											@php $i = 0 @endphp

											@foreach ($users as $item)
											<tr>
												<td>{{ ++$i }}</td>
												<td>{{ $item->full_name }}</td>
												<td>{{ $item->phone }}</td>
												<td>{{ $item->email }}</td>
												<td>{{ $item->mac_address }}</td>
												<td>{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('%H:%S - %d %B %Y') }}</td>
												<td>{{ \Morilog\Jalali\Jalalian::forge($item->updated_at)->ago() }}</td>
												<td>
													<form action="{{ route('user.destroy', ['user' => $item->id]) }}" method="POST">
														@if (auth()->user()->type == 1)
															@if (! $item->type == 1)

																<button type="submit" itemid="{{ $item->id }}" class="btn btn-danger delete-item"><i class="icon ti-close"></i> حذف</button>
															@endif
														@endif
														@method('delete')
														@csrf
													</form>	
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
		// Data table JavaScript
		'vendors/bower_components/datatables/media/js/jquery.dataTables.min.js',
		'dist/js/dataTables-data.js',
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
		// Init Add Product Page JavaScript
		'dist/js/group_ajax.js',
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>
	@endforeach
	
	<script>
		$('.delete-item').on('click',function(event){
			event.preventDefault();
			var title = $(this).parent().parent().prev().prev().prev().text();
			var id = $(this).attr('itemid');
			var form = $(this).parent();

			swal({   
				title: "مطمین هستید ؟",   
				text: "برای پاک کردن کاربر " + title + " مطمین هستید ؟",   
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
					swal("لغو شد", "هیچ کاربری حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection