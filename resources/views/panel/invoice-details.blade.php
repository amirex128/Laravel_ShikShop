@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		//alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
		// Custom CSS
		'dist/css/style.css'
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach

	<style>
	.timeline > li > .timeline-panel {
		text-align: right;
	}
	thead tr {
		background: #848484;
	}
	thead tr th {
		color: #fff !important;
		font-size: 14px !important;
	}
	.address-head {
		font-size: 16px;
		margin-bottom: 20px !important;
		/* display: inline-block; */
	}
	.address-head i {
		margin-left: 5px;
	}
	blockquote {
		border-left: none;
		border-right: 4px solid #f83f37;
		font-size: 13px;
	}
	.btn-info.fancy-button:hover {
		background: #ed1b60 !important;
	}
	.btn-warning.fancy-button:hover {
		background: #ffbf36 !important;
	}
	.btn-dark.fancy-button:hover {
		background: #324148 !important;
		color: #fff !important;
	}
	.btn-orange.fancy-button:hover {
		background: #ff9528 !important;
		color: #fff !important;
	}
	.btn-primary.fancy-button:hover {
		background: #0092ee !important;
	}
	.btn-success.fancy-button:hover {
		background: #22af47 !important;
	}
	.btn-danger.fancy-button:hover {
		background: #f83f37 !important;
	}
	</style>
@endsection

@section('content')
	<div class="container">
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">جزئیات سفارش</h5>
			</div>

			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>جزئیات سفارش</span></li>
					<li>داشبورد</li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default border-panel card-view">
					<div class="panel-heading">
						<div class="pull-right">
							<h3 class="panel-title txt-dark mt-10">مشخصات فاکتور #{{$invoice->id}}</h3>
						</div>
						<div class="pull-left">
							<?php
							switch ($invoice->status) {
								case 0: $status = ['پرداخت نشده', 'info']; break;
								case 1: $status = ['در انتظار پرداخت', 'warning']; break; 
								case 2: $status = ['پرداخت شده', 'dark']; break;
								case 3: $status = ['در حال بررسی', 'orange']; break;
								case 4: $status = ['در حال بسته بندی', 'warning']; break;
								case 5: $status = ['در حال ارسال', 'primary']; break;
								case 6: $status = ['ارسال شده', 'success']; break;
								case 7: $status = ['لغو شده', 'danger']; break;
								default: $status = ['پرداخت نشده', 'info'];
							}
							?>
							<div class="button-list pull-left">
								<button type="button" class="btn btn-default btn-outline btn-icon left-icon mt-0" onclick="javascript:window.print();"> 
									<i class="fa fa-print"></i><span> چاپ</span> 
								</button>
								<span class="btn btn-{{$status[1]}} mr-10 mt-0">وضعیت : {{$status[0]}}</span>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
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
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-6 text-right">
									<span class="txt-dark head-font inline-block capitalize-font mb-5 address-head">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
										<b>آدرس خریدار:</b>
									</span>
									<address class="mb-15">
										<span class="mb-5">{{$invoice->user->state}} ، {{$invoice->user->city}}</span><br/>
										{{$invoice->user->address}}<br>
										<b>کد پستی : </b>{{$invoice->user->postal_code}}
									</address>
								</div>
								<div class="col-xs-6">
									<span class="txt-dark head-font inline-block capitalize-font mb-5 address-head">
										<i class="fa fa-plane" aria-hidden="true"></i>
										آدرس مقصد ارسال سفارش:
									</span>
									<address class="mb-15">
										{{$invoice->destination}}<br>
										<b>کد پستی : </b>{{$invoice->postal_code}}
									</address>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-6">
									<address>
										<span class="txt-dark head-font capitalize-font mb-5 address-head">
											<i class="fa fa-user" aria-hidden="true"></i>
											خریدار :
										</span>
										{{$invoice->user->full_name}}<br/><br/>
										<b>شماره تلفن : </b>{{$invoice->user->phone}}<br/>
										<b>آدرس ایمیل : </b>{{$invoice->user->email}}
									</address>
								</div>
								<div class="col-xs-6 text-right">
									<address>
										<span class="txt-dark head-font capitalize-font mb-5 address-head">
											<i class="fa fa-calendar" aria-hidden="true"></i>
											تاریخ ثبت سفارش:
										</span>
										<b class="txt-dark">ثبت :</b> {{ \Morilog\Jalali\Jalalian::forge($invoice->created_at)->format('%H:%S - %d %B %Y') }}<br/><br/>
										@if ($invoice->payment)
										<b class="txt-dark">پرداخت :</b> {{ \Morilog\Jalali\Jalalian::forge($invoice->payment)->format('%H:%S - %d %B %Y') }}
										<b class="txt-dark">کد احراز پرداخت :</b> {{$invoice->auth_code}}
										<b class="txt-dark">شناسه پرداخت :</b> {{$invoice->payment_code}}
										@else
										<b class="txt-dark">پرداخت :</b> <span class="label label-danger">هنوز پرداخت نشده</span>
										@endif
									</address>
								</div>
							</div>

							<div class="row mt-20">
								@if ($invoice->buyer_description)
								<div class="col-md-12">
									<span class="txt-dark head-font inline-block capitalize-font mb-5 address-head">
										<i class="fa fa-commenting-o" aria-hidden="true"></i>
										<b>توضیحات مشتری :</b>
									</span>
									<span class="mb-15">
										<blockquote><pre>{{$invoice->buyer_description}}</pre></blockquote>
									</span>
								</div>
								@endif
							</div>

							<div class="row">
								<div class="col-md-12">
									<span class="txt-dark head-font inline-block capitalize-font mb-5 address-head">
										<i class="fa fa-commenting" aria-hidden="true"></i>
										<b>توضیحات فروشنده :</b>
									</span>
									<span class="mb-15">
										<div class="input-group mb-15">
											<textarea class="form-control" id="short_description" name="short_description" style="resize:none;" placeholder="توضیح خود درباره این سفارش را وارد کنید" rows="2">@if($invoice->admin_description){{$invoice->admin_description}}@endif</textarea>
											<span class="input-group-btn">
												<button type="button" style="height:54px" onclick="window.location = '/panel/invoice/{{$invoice->id}}/description/' + this.parentNode.previousElementSibling.value" class="btn btn-orange btn-anim"><i class="icon-rocket"></i><span class="btn-text">ثبت</span></button>
											</span> 
										</div>
									</span>
								</div>
							</div>
							
							<div class="seprator-block"></div>
							
							<div class="invoice-bill-table">
								<div class="table-responsive">
									<table class="table table-hover" id="invoice-table">
										<thead>
											<tr class="btn-dark">
												<th><b>تصویر محصول</b></th>
												<th><b>نام محصول</b></th>
												<th><b>قیمت</b></th>
												<th><b>تعداد</b></th>
												<th><b>رنگ</b></th>
												<th><b>گارانتی</b></th>
												<th><b>جمع</b></th>
											</tr>
										</thead>
										<tbody>
											@foreach ($invoice->items as $item)
											<?php
											$price = $item->price;
											if ($item->unit)
												$price = $price * $dollar_cost;
	
											if ($item -> offer != 0)
												$price = $price - ($item->offer * $price) / 100;  
											?>
											<tr>
												<td><img src="{{$item->variation->product->photo}}" /></td>
												<td>
													{{$item->variation->product->name}}<br/>
													{{$item->variation->product->code}}
												</td>
												<td class="num-comma">{{$price}}</td>
												<td>{{$item->count}}</td>
												<td>{!!($item->variation->color) ? '<span class="badge badge-primary" style="background: '.$item->variation->color->value.'">'.$item->variation->color->name.'</span>' : 'رنگی انتخاب نشده است'!!}</td>
												<td>{{($item->variation->warranty)? $item->variation->warranty->name : 'بدون گارانتی'}}</td>
												<td class="num-comma">{{$price * $item->count}}</td>
											</tr>
											@endforeach
											<tr class="txt-dark">
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>جمع فاکتور</td>
												<td><span class="num-comma">{{$invoice->total}}</span> تومان</td>
											</tr>
											<tr class="txt-dark">
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>هزینه ارسال</td>
												<td><span class="num-comma">{{$invoice->shipping_cost}}</span> تومان</td>
											</tr>
											<tr class="txt-dark">
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>تخفیف سفارش</td>
												<td><span class="num-comma">{{$invoice->offer}}</span> تومان</td>
											</tr>
											<tr class="txt-dark">
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>جمع کلی</td>
												<td><span class="num-comma">{{$invoice->total + $invoice->shipping_cost}}</span> تومان</td>
											</tr>
										</tbody>
									</table>
								</div>
								
								<div class="row">
									<div class="button-list pull-right status-buttons d-flex justify-content-center">
										<button status="0" class="p-2 btn btn-info @if($invoice->status!=0) btn-outline fancy-button @endif btn-0 mr-10">پرداخت نشده</button>
										<button status="1" class="p-2 btn btn-warning @if($invoice->status!=1) btn-outline fancy-button @endif btn-0 mr-10 mr-10">در انتظار پرداخت</button>
										<button status="2" class="p-2 btn btn-dark @if($invoice->status!=2) btn-outline fancy-button @endif btn-0 mr-10 mr-10">پرداخت شده</button>
										<button status="3" class="p-2 btn btn-orange @if($invoice->status!=3) btn-outline fancy-button @endif btn-0 mr-10 mr-10">در حال بررسی</button>
										<button status="4" class="p-2 btn btn-warning @if($invoice->status!=4) btn-outline fancy-button @endif btn-0 mr-10 mr-10">در حال بسته بندی</button>
										<button status="5" class="p-2 btn btn-primary @if($invoice->status!=5) btn-outline fancy-button @endif btn-0 mr-10 mr-10">در حال ارسال</button>
										<button status="6" class="p-2 btn btn-success @if($invoice->status!=6) btn-outline fancy-button @endif btn-0 mr-10 mr-10">ارسال شده</button>
										<button status="7" class="p-2 btn btn-danger @if($invoice->status!=7) btn-outline fancy-button @endif btn-0 mr-10 mr-10">لغو شده</button>
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
		'vendors/bower_components/jquery/dist/jquery.min.js',
		// Bootstrap Core JavaScript
		'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// js numeral formatter
		'js/numeral.min.js',
		// Init JavaScript
		'dist/js/init.js',
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach

	<script>
		var nums = document.getElementsByClassName('num-comma');

		for (num in nums) {
			nums[num].innerHTML = numeral(nums[num].innerHTML).format('0,0');
		}

		$('.status-buttons .fancy-button').on('click',function(){
			var id = '{{$invoice->id}}';
			var type = $(this).text();
			var status = $(this).attr('status');

			swal({   
				title: "مطمین هستید ؟",   
				text: "برای تغییر وضعیت فاکتور به \"" + type + "\" مطمین هستید ؟",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#f83f37",   
				confirmButtonText: "بله",   
				cancelButtonText: "خیر",   
				closeOnConfirm: false,   
				closeOnCancel: false 
			}, function(isConfirm){   
				if (isConfirm) {
					window.location = '/panel/invoice/' + id + '/status/' + status; 
				} else {     
					swal("لغو شد", "وضعیت فاکتور تغییری نکرد", "error");   
				} 
			});
			return false;
		});
	</script>

@endsection		