<!DOCTYPE html>
<html dir="{{app()->LaravelLocalization::getCurrentLocaleDirection()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('commonmodule::site.shopping') -@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('commonmodule::includes.css')
    @yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('commonmodule::includes.header')
@include('commonmodule::includes.aside')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

    @yield('content-header')

    @yield('content')
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('commonmodule::includes.footer')


    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
@include('commonmodule::includes.js')


</body>
</html>
