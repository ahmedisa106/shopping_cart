<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('frontmodule::includes.css')


</head>

<body>

<div class="super_container">

    <!-- Header -->

@include('frontmodule::includes.header')

@yield('content')

<!-- Footer -->

@include('frontmodule::includes.footer')

<!-- Copyright -->


</div>

@include('frontmodule::includes.js')

</body>

</html>
