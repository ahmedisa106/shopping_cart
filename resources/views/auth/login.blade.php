@extends('frontmodule::layouts.master')
@section('css')
    <link rel="icon" type="image/png" href="{{asset('/assets/front/login')}}/images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/login')}}/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/login')}}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/login')}}/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/login')}}/vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/login')}}/vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/login')}}/vendor/animsition/css/animsition.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/login')}}/vendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/login')}}/vendor/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/login')}}/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/login')}}/css/main.css">


@stop
@section('content')
    <div class="limiter ">
        <div class="container-login100 " style="background-image: url('public/assets/front/login/images/bg-01.jpg');">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33 form ">
                <form class="login100-form validate-form flex-sb flex-w " method="post" action="{{route('user.login')}}">
                    {{csrf_field()}}
                    <span class="login100-form-title p-b-53">
						Login In With
					</span>

                    <a href="#" class="btn-face m-b-20">
                        <i class="fa fa-facebook-official"></i>
                        Facebook
                    </a>

                    <a href="#" class="btn-google m-b-20">
                        <img src="{{asset('/assets/front/login')}}/images/icons/icon-google.png" alt="GOOGLE">
                        Google
                    </a>

                    <div class="p-t-31 p-b-9">
						<span class="txt1">
							Eamil
						</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="email" name="email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>

                        <a href="#" class="txt2 bo1 m-l-5">
                            Forgot?
                        </a>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn">
                            Sign In
                        </button>
                    </div>

                    <div class="w-full text-center p-t-55">
						<span class="txt2">
							Not a member?
						</span>

                        <a href="{{route('register')}}" class="txt2 bo1">
                            Sign up now
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection




@section('js')
    <div id="dropDownSelect1"></div>
    <!--===============================================================================================-->
    <script src="{{asset('/assets/front/login')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{asset('/assets/front/login')}}/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{asset('/assets/front/login')}}/vendor/bootstrap/js/popper.js"></script>
    <script src="{{asset('/assets/front/login')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{asset('/assets/front/login')}}/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{asset('/assets/front/login')}}/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{asset('/assets/front/login')}}/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="{{asset('/assets/front/login')}}/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="{{asset('/assets/front/login')}}/js/main.js"></script>


@stop
