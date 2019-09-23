<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
	<title>ورود به @isset($options['site_name']) {{$options['site_name']}} @else سایت @endisset</title>
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
				<div class="login100-pic js-tilt" data-tilt>
					<img src="/logo/{{ $options['site_logo'] }}" alt="IMG">
				</div>

				<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
					@csrf

					<span class="login100-form-title">
						ورود به @isset($options['site_name']) {{$options['site_name']}} @else سایت @endisset
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input type="email" placeholder="آدرس ایمیل" class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input type="password" placeholder="رمز عبور" class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>

						@if ($errors->has('password'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
					{{--<div>--}}
						{{--<div class="g-recaptcha" data-sitekey="6LcN95IUAAAAAHywEzHcQb2FgcYHedbzlnLGYoD7"></div>--}}
					{{----}}
					{{--</div>--}}
					{{----}}
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							ورود به حساب
						</button>
					</div>

					{{--<div class="text-center p-t-12">--}}
						{{-- <span class="txt1">--}}
							{{----}}
						{{--</span> --}}
						{{--<a class="txt2" href="{{ route('password.request') }}">--}}
							{{--رمز عبور خود را فراموش کرده اید ؟--}}
						{{--</a>--}}
					{{--</div>--}}

					{{--<div class="text-center p-t-136">--}}
						{{--<a class="txt2" href="{{ route('register') }}">--}}
							{{--<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>--}}
							{{--هنوز ثبت نام نکرده اید ؟--}}
						{{--</a>--}}
					{{--</div>--}}
				</form>
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
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

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