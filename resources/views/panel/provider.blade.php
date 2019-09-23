@extends('panel.master.main')

@section('styles')
    <?php $styles = [
        // alerts CSS
        'vendors/bower_components/sweetalert/dist/sweetalert.css',
        //  Custom Fonts
        'dist/css/font-awesome.min.css',
        //  Calendar CSS
        'vendors/bower_components/fullcalendar/dist/fullcalendar.css"',
        //  Custom CSS
        'dist/css/style.css',
    ]; ?>

    @foreach ($styles as $style)
        <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
    @endforeach

    <style>
        .product-card {
            float: right;
        }

        .product-card .info {
            height: 130px;
            overflow: auto;
        }

        .product-card .label {
            position: absolute;
            bottom: 10px;
            left: 0px;
            box-shadow: 0px 0px 10px -3px #000;
            padding: 5px 10px !important;
        }

        .product-card .btn.btn-circle {
            height: 20px;
            width: 20px;
        }

        .product-card .btn.btn-circle i {
            font-size: 10px !important;
        }

        .product-pic {
            height: 250px;
        }

        .label.flag {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 6px 10px;
            font-size: 20px;
            background: #9797979e;
            box-shadow: 0px 0px 10px #000;
            border-radius: 5px;
            height: 32px;
        }

        .gray {
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
        }

        .shadow {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0px;
            left: 0px;
            background: #00000085;
        }

        .photo .options {
            z-index: 100;
        }

        .pagination {
            position: relative;
            top: 15px;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .delete-item {
            background: none;
            border: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">


        <!-- Title -->
        <div class="row heading-bg">
            <!-- Breadcrumb -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">تامین کننده ها</h5>
            </div>


        <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->

        <!-- Group Row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="row mr-5">
                            <div class="col-6">
                            </div>
                            <div class="col-6 ">
                                <a class="btn btn-danger" href="/panel/provider/create">ایجاد تامین کننده</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>توضیحات</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                @foreach(\App\Models\Provider::all() as $item)

                                <tr>
                                        <td>{{$item->title}}</td>
                                        <td>{{str_limit($item->description,70)}}</td>
                                    <td>
                                        <form  action="/panel/provider/{{$item->id}}" method="POST">
                                            <div class="d-flex flex-column bg-secondary">
                                                <div>
                                                    <a class="d-block btn btn-success btn-block"  href="/panel/provider/{{$item->id}}/edit">ویرایش</a>
                                                </div>
                                                <div>
                                                    <input class="d-block btn btn-danger btn-block" value="حذف" type="submit" itemid="{{ $item->id }}" />
                                                </div>
                                            </div>

                                            @method('delete')
                                            @csrf
                                        </form>
                                    </td>

                                </tr>
                                @endforeach

                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- Group Row -->


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
        // Sweet-Alert
        'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
        'dist/js/sweetalert-data.js',
        // Switchery JavaScript
        'vendors/bower_components/switchery/dist/switchery.min.js',
        // Fancy Dropdown JS
        'dist/js/dropdown-bootstrap-extended.js',
        // Init JavaScript
        'dist/js/init.js',
    ]; ?>

    @foreach ($scripts as $script)
        <script src="{{ asset($script) }}"></script>
    @endforeach

    <script>
        $('.delete-item').on('click', function () {
            var title = $(this).parent().parent().next().find('h5').text();
            var id = $(this).attr('product');
            var form = $(this).parent();

            swal({
                title: "مطمین هستید ؟",
                text: "برای پاک کردن مقاله " + title + " مطمین هستید ؟",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f83f37",
                confirmButtonText: "بله",
                cancelButtonText: "خیر",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    form.submit();
                } else {
                    swal("لغو شد", "هیچ مقاله ای حذف نشد :)", "error");
                }
            });
            return false;
        });
    </script>
@endsection