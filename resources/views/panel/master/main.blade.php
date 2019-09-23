<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>شیک شاپ</title>
	<meta name="description" content="Splasher is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Splasher Admin, Splasheradmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
	<meta name="csrf-token" content="{{@csrf_token()}}">
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<link rel="stylesheet" href="{{ asset('css/font.css') }}">
	@yield('styles');
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
<div id="app">
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
	<div class="wrapper theme-2-active navbar-top-light horizontal-nav">
	@include('panel.master.header')
	
	<!-- Main Content -->
		<div class="page-wrapper">
		@yield('content')
		
		<!-- Footer -->
		@include('panel.master.footer')
		<!-- /Footer -->
		
		</div>
		<!-- /Main Content -->
	
	</div>
</div>
    <!-- /#wrapper -->
	{{--<script src="{{asset('js/app.js')}}"></script>--}}
	<!-- JavaScript -->
	@yield('scripts')
</body>

</html>
