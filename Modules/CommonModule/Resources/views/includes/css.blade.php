<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{asset('/assets/admin')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('/assets/admin')}}/bower_components/font-awesome/css/font-awesome.min.css">

<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('/assets/admin')}}/bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{asset('/assets/admin')}}/dist/css/skins/_all-skins.min.css">

<!-- jvectormap -->
<link rel="stylesheet" href="{{asset('/assets/admin')}}/bower_components/jvectormap/jquery-jvectormap.css">
<!-- Date Picker -->
<link rel="stylesheet"
      href="{{asset('/assets/admin')}}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{asset('/assets/admin')}}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{asset('/assets/admin')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->




@if(App()->getLocale() == 'ar')
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/rtl/bootstrap-rtl.min.css')}}">
    <style>
        body, h1, h2, h3, h4, h5, h6, span {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
@endif

@if(App()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('assets/admin/rtl/font-awesome-rtl.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/rtl/AdminLTE-rtl.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/rtl/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/rtl/rtl.css')}}">
@else
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->


    <link rel="stylesheet" href="{{asset('/assets/admin')}}/dist/css/AdminLTE.min.css">



@endif

<!-- Google Font -->
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
