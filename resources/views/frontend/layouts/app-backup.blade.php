<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="x-ua-compatible" content="ie=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
     <title>Furniture Ecommerce Website</title>
     <meta name="keywords" content="" />
     <meta name="description" content="">
     <meta name="author" content="">

    <!-- site Favicon -->
    <link rel="icon" href="{{asset('public/frontend/assets/images/favicon/favicon-3.png')}}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{asset('public/frontend/assets/images/favicon/favicon-3.png')}}" />
    <meta name="msapplication-TileImage" content="{{asset('public/frontend/assets/images/favicon/favicon-3.png')}}" />

    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/vendor/ecicons.min.css')}}" />
    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/jquery-ui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/countdownTimer.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/slick.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/nouislider.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/bootstrap.css')}}" />
    <!-- Main Style -->
    @if (Route::currentRouteName() == "index")
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/demo3.css')}}" />
    @else
        <!-- Main Style -->
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/style.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/responsive.css')}}" />
    @endif



</head>
    <body>
        @include('frontend.layouts.header')
            @yield('content')
        @include('frontend.layouts.footer')
    </body>
</html>
