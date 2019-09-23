<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
	<title>بازیابی رمز عبور</title>
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

				<form method="POST" action="{{ route('password.email') }}" class="login100-form validate-form">
					@csrf

					<span class="login100-form-title">
						بازیابی رمز عبور
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input type="email" placeholder="آدرس ایمیل" class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{old('email') }}" required autofocus>
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
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							ارسال لینک بازیابی رمز
						</button>
					</div>
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