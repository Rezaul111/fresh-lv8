<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
{{--    <!-- Favicon icon -->--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}admin/assets/images/favicon.png">--}}
    <title> Admin || @yield('title') </title>
    @stack('css')
    <!-- Custom CSS -->
    <link href="{{asset('/')}}admin/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="{{asset('/')}}admin/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="{{asset('/')}}admin/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{asset('/')}}admin/assets/dist/css/style.min.css" rel="stylesheet">
    <link href="{{asset('/')}}admin/assets/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">


</head>

<body>

<div id="main-wrapper">
   @include('admin.includes.header')

    @include('admin.includes.menu')

   @yield('body')

</div>



<script src="{{asset('/')}}admin/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('/')}}admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="{{asset('/')}}admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<script src="{{asset('/')}}admin/assets/dist/js/app.min.js"></script>
<script src="{{asset('/')}}admin/assets/dist/js/app.init.js"></script>
<script src="{{asset('/')}}admin/assets/dist/js/app-style-switcher.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('/')}}admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="{{asset('/')}}admin/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="{{asset('/')}}admin/assets/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="{{asset('/')}}admin/assets/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="{{asset('/')}}admin/assets/dist/js/custom.min.js"></script>

<script src="{{asset('/')}}admin/assets/extra-libs/toastr/dist/build/toastr.min.js"></script>
<script src="{{asset('/')}}admin/assets/extra-libs/toastr/toastr-init.js"></script>
<!--This page JavaScript -->


@stack('js')

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";

    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
</body>

</html>
