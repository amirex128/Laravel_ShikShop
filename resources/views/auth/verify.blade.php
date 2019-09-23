<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
	<title>ورود به @isset($site_name) {{$site_name}} @else سایت @endisset</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/form_asset/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/form_asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/form_asset/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/form_asset/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/form_asset/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/form_asset/css/util.css">
	<link rel="stylesheet" type="text/css" href="/form_asset/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/font.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="container" dir="rtl">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">{{ __('تایید آدرس ایمیل') }}</div>

								<div class="card-body">
									@if (session('resent'))
										<div class="alert alert-success" role="alert">
											{{ __('یک لینک به آدرس ایمیل شما ارسال شده است .') }}
										</div>
									@endif

									{{ __('لطفا قبل از استفاده از حساب خود ، آدرس ایمیل خود را تایید کنید .') }}
									{{ __('در صورتی که ایمیلی دریافت نکرده اید ') }}, <a href="{{ route('verification.resend') }}">{{ __('برای ارسال مجدد ایمیل اینجا را کلیک کنید') }}</a>.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="/form_asset/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	{{-- <script src="/form_asset/vendor/bootstrap/js/popper.js"></script> --}}
	{{-- <script src="/form_asset/vendor/bootstrap/js/bootstrap.min.js"></script> --}}
<!--===============================================================================================-->
	{{-- <script src="/form_asset/vendor/select2/select2.min.js"></script> --}}
<!--===============================================================================================-->
	<script src="/form_asset/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	{{-- <script src="/form_asset/js/main.js"></script> --}}

</body>
</html>