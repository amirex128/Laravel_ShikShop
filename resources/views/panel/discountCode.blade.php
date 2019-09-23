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

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">
					@isset($discountCode) ویرایش کد تخفیف @else ثبت کد تخفیف جدید @endisset
				</h5>
			</div>
		
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">
						<span>@isset($discountCode) ویرایش کد تخفیف @else ثبت کد تخفیف جدید @endisset</span>
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
								<form action="@isset($discountCode) {{ route('discountCode.update', $discountCode->id) }} @else {{ route('discountCode.store') }} @endisset" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>مشخصات کد تخفیف</h6>
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
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10" for="title">کد تخفیف</label>
												<div class="input-group">
													<input type="text" name="code" id="code" @isset($discountCode) value="{{$discountCode->code}}" @else value="{{old('code')}}" @endisset class="form-control" placeholder="مثلا : spring_2018_offer" />
													<div class="input-group-addon"><i class="ti-shortcode"></i></div>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10" for="title">ارزش کد تخفیف</label>
												<div class="input-group">
													<input type="number" name="value" id="value" @isset($discountCode) value="{{$discountCode->value}}" @else value="{{old('value')}}" @endisset class="form-control" placeholder="مثلا : 5000 تومان" />
													<div class="input-group-addon"><i class="ti-money"></i></div>
												</div>
											</div>
										</div>
									</div>

									<hr class="light-grey-hr"/>
									
									<div class="form-actions">
										<button class="btn @isset($discountCode) btn-warning @else btn-primary @endisset btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i>
											<span>@isset($discountCode) ویرایش @else ثبت @endisset کد تخفیف</span>
										</button>
										<div class="clearfix"></div>
									</div>

									@csrf

									@isset($discountCode) @method('put') @endisset
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
				<h5 class="txt-dark">لیست کد تخفیف ها</h5>
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
												<th>کاربر</th>
												<th>ارزش</th>
												<th>کد</th>
												<th>تاریخ استفاده</th>
												<th>تاریخ ثبت</th>
												<th>تاریخ آخرین ویرایش</th>
												<th>عملیات</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>کاربر</th>
												<th>ارزش</th>
												<th>کد</th>
												<th>تاریخ استفاده</th>
												<th>تاریخ ثبت</th>
												<th>تاریخ آخرین ویرایش</th>
												<th>عملیات</th>
											</tr>
										</tfoot>
										<tbody>
											@php $i = 0 @endphp

											@foreach ($discountCodes as $item)
											<tr>
												<td>{{ ++$i }}</td>
												<td>@if($item->user) {{ $item->user->full_name }} @endif</td>
												<td class="num-comma">{{ $item->value }} تومان</td>
												<td>{{ $item->code }}</td>
												<td>
													@if ($item->using_time)
														{{ \Morilog\Jalali\Jalalian::forge($item->using_time)->format('%H:%S - %d %B %Y') }}
													@endif
												</td>
												<td>{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('%H:%S - %d %B %Y') }}</td>
												<td>{{ \Morilog\Jalali\Jalalian::forge($item->updated_at)->ago() }}</td>
												<td>
													<form action="{{ route('discountCode.destroy', ['discountCode' => $item->id]) }}" method="POST">
														<a href="{{ route('discountCode.edit', ['discountCode' => $item->id]) }}" class="btn btn-warning"><i class="icon ti-pencil"></i> ویرایش</a>
														<button type="submit" itemid="{{ $item->id }}" class="btn btn-danger delete-item"><i class="icon ti-close"></i> حذف</button>
														
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
		// js numeral formatter
		'js/numeral.min.js',
		// Init Add Product Page JavaScript
		'dist/js/group_ajax.js',
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>
	@endforeach
	
	<script>
		var nums = document.getElementsByClassName('num-comma');

		for (num in nums) {
			nums[num].innerHTML = numeral(nums[num].innerHTML).format('0,0');
		}

		$('.delete-item').on('click',function(event){
			event.preventDefault();
			var title = $(this).parent().parent().prev().prev().prev().text();
			var id = $(this).attr('itemid');
			var form = $(this).parent();

			swal({   
				title: "مطمین هستید ؟",   
				text: "برای پاک کردن کد تخفیف " + title + " مطمین هستید ؟",   
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
					swal("لغو شد", "هیچ کد تخفیفی حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection