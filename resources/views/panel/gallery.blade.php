@extends('panel.master.main')

@section('styles')
	<?php $styles = [
        //alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
        // Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',
		// Custom CSS
		'dist/css/style.css'
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
    @endforeach
    
    <style>
    .project-gallery a {
        box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
        transition: box-shadow 300ms;
    }
    
    .project-gallery a:hover {
        box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
    }
    .photo-actions {
        width: 60px;
        position: absolute;
        top: 10px;
        left: 10px;
    }
    .photo-actions a, .photo-actions span {
        width: 20px;
        height: 20px;
        margin: 0px !important;
        padding: 4px;
        box-shadow: 0px 0px 0px 0px #000;
        transition: box-shadow 300ms;
    }

    .photo-actions a:hover, .photo-actions span:hover {
        box-shadow: 0px 0px 15px -5px #000;
    }
    
    
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Title -->
        <div class="row heading-bg">
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active"><span>گالری</span></li>
                <li><a href="/panel">داشبورد</a></li>
            </ol>
            </div>
            <!-- /Breadcrumb -->
            
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">گالری</h5>
            </div>
        </div>
        <!-- /Title -->
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default border-panel card-view">
                    <div class="panel-heading">
                        <div class="pull-right">
                            <h6 class="panel-title txt-dark">@isset($edit) ویرایش اطلاعات تصویر @else آپلود تصویر جدید @endisset</h6>
                        </div>
                        <div class="clearfix"></div>
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

                    <div class="panel-body">
                        <form action="@isset($edit) /panel/gallery/update @else /panel/gallery/upload @endisset" method="POST" enctype="multipart/form-data">
                            <div class="col-md-8">
                                <div class="form-wrap">
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="exampleInputuname_2">نام تصویر</label>
                                        <div class="input-group">
                                            <input type="text" @isset($edit) value="{{$selected->name}}" @else value="{{old('name')}}" @endisset name="name" class="form-control" id="exampleInputuname_2" placeholder="برای مثال : Apple_iPhone_X_back">
                                            <div class="input-group-addon"><i class="icon-picture"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="exampleInputEmail_2">توضیح کوتاه</label>
                                        <div class="input-group">
                                            <input type="text" @isset($edit) value="{{$selected->description}}" @else value="{{old('description')}}" @endisset name="description" class="form-control" id="exampleInputEmail_2" placeholder="یک توضیح کوتاه یک خطی درباره عکس">
                                            <div class="input-group-addon"><i class="icon-speech"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn @isset($edit) btn-warning @else btn-success @endisset pull-left mr-10">@isset($edit) ویرایش اطلاعات @else آپلود تصویر @endisset</button>
                                    </div>
                                    @isset($edit)
                                    <input type="hidden" name="id" value="{{$selected->id}}" />
                                    @endisset
                                    @csrf
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mt-10 mb-10">
                                    <input type="file" @isset($edit) data-default-file="/uploads/{{$selected->photo}}" disabled @endisset name="photo" id="input-file-now" class="dropify" />
                                </div>	
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="seprator-block"></div>

        <!-- Row -->
        <div class="row" dir="ltr">
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="gallery-wrap">
                                <div class="portfolio-wrap project-gallery">
                                    <ul id="portfolio_1" class="portf auto-construct  project-gallery" data-col="4">
                                        @empty ($photos[0])
                                            <div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                هیچ تصویری تا کنون آپلود نشده است
                                            </div>
                                        @else
                                            @foreach ($photos as $photo)
                                                <li  class="item tall"  data-src="{{ asset('uploads/'.$photo->photo) }}" data-sub-html="{{$photo->description}}" >
                                                    <a href="">
                                                        <img class="img-responsive" src="{{ asset('uploads/'.$photo->photo) }}"  alt="توضیحی برای تصویر ثبت نشده است" />
                                                        <span class="hover-cap">
                                                            @if($photo->name) {{$photo->name}} @else {{$photo->photo}} @endif
                                                        </span>
                                                        <div class="photo-actions">
                                                            <span href="/panel/gallery/edit/{{$photo->id}}" class="edit-photo badge badge-warning inline-block mb-10">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </span>
                            
                                                            <span photo="{{$photo->id}}" filename="{{$photo->photo}}" class="delete-photo badge badge-danger inline-block">
                                                                <i class="zmdi zmdi-close"></i>
                                                            </span>
                                                        </div>
                                                    </a>

                                                </li>
                                            @endforeach
                                        @endempty
                                    </ul>
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
        // Gallery JavaScript
        'dist/js/isotope.js',
        'dist/js/lightgallery-all.js',
        'dist/js/froogaloop2.min.js',
        'dist/js/gallery-data.js',
        // Slimscroll JavaScript
        'dist/js/jquery.slimscroll.js',
        // Fancy Dropdown JS
        'dist/js/dropdown-bootstrap-extended.js',
        // Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
        // Bootstrap Daterangepicker JavaScript
		'vendors/bower_components/dropify/dist/js/dropify.min.js',
        // Owl JavaScript
        'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
        // Switchery JavaScript
        'vendors/bower_components/switchery/dist/switchery.min.js',
        // Init JavaScript
        'dist/js/init.js',
        'dist/js/gallery_data.js'
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>
    @endforeach
    
    <script> $('.dropify').dropify(); </script>
@endsection