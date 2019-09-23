@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// Data table CSS
		'vendors/bower_components/datatables/media/css/jquery.dataTables.min.css',
		// Custom CSS
		'dist/css/style.css'
	]; ?>

	@foreach ($styles as $style)
	<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach

	<style>
	.label.label-orange {
		background: #ff9528;
	}
	.label.label-dark {
		background: #000;
	}
	.pagination {
		position: relative;
		top: 15px;
		width: 100%;
		display: flex;
		justify-content: center;
	}
	</style>
@endsection
	
@section('content')
	<div class="container">
		
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">لیست سفارشات</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">لیست سفارشات</li>
					<li>داشبورد</li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		
		<!-- Row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default border-panel card-view">
					<div class="panel-heading">
						<div class="pull-right">
							<h6 class="panel-title txt-dark">سفارشات</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="datable_1" class="table  display table-hover mb-30">
										<thead>
											<tr>
												<th>شناسه فاکتور</th>
												<th>خریدار</th>
												<th>مبلغ</th>
												<th>وضعیت</th>
												<th>ثبت سفارش</th>
												<th>پرداخت</th>
												<th>اطلاعات بیشتر</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>شناسه فاکتور</th>
												<th>خریدار</th>
												<th>مبلغ</th>
												<th>وضعیت</th>
												<th>ثبت سفارش</th>
												<th>پرداخت</th>
												<th>اطلاعات بیشتر</th>
											</tr>
										</tfoot>

										<tbody>
											@foreach ($orders as $order)
											<tr>
												<td>#{{$order->id}}</td>
												<td>{{$order->full_name}}</td>
												<td><span class="num-comma">{{$order->total}}</span> تومان</td>
												<td>
													<?php
													switch ($order->status) {
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
													<span class="label label-{{$status[1]}}">{{$status[0]}}</span>
												</td>
												<td title="{{ \Morilog\Jalali\Jalalian::forge($order->created_at)->format('%H:%S - %d %B %Y') }}">
													{{ \Morilog\Jalali\Jalalian::forge($order->created_at)->ago() }}
												</td>

												@if ($order->payment)
													<td title="{{ \Morilog\Jalali\Jalalian::forge($order->payment)->format('%H:%S - %d %B %Y') }}">
														{{ \Morilog\Jalali\Jalalian::forge($order->payment)->ago() }}
													</td>
												@else
													<td><span class="label label-danger">هنوز پرداخت نشده</span></td>
												@endif
												<td>
													<a href="/panel/invoice/{{$order->id}}">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>	
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								
								{{ $orders->links() }}
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
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Init JavaScript
		'dist/js/init.js',
		// js numeral formatter
		'js/numeral.min.js'
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach
	
	<script>
		var nums = document.getElementsByClassName('num-comma');

		for (num in nums) {
			nums[num].innerHTML = numeral(nums[num].innerHTML).format('0,0');
		}
	</script>
@endsection