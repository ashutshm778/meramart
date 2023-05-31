<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <title>{{optional(websiteSettingValue('meta_title'))->image}}</title>
        <meta name="keywords" content="{{optional(websiteSettingValue('meta_keyword'))->image}}" />
        <meta name="description" content="{{optional(websiteSettingValue('meta_description'))->image}}">
        <meta name="author" content="{{env('APP_URL')}}">
        <meta name="msapplication-TileImage" content="{{asset('public/frontend/assets/images/favicon/favicon-3.png')}}" />
        <link rel="icon" href="{{asset('public/frontend/assets/images/favicon/favicon-3.png')}}" sizes="32x32" />
        <link rel="apple-touch-icon" href="{{asset('public/frontend/assets/images/favicon/favicon-3.png')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/vendor/ecicons.min.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/animate.css')}}" />

        {{-- <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/jquery-ui.min.css')}}" /> --}}

        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/countdownTimer.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/slick.min.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins/bootstrap.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/custom-style.css')}}" />

        @if(Route::currentRouteName() == 'index')
            <link rel="stylesheet" href="{{asset('public/frontend/assets/css/demo3.css')}}" />
        @else
            <link rel="stylesheet" href="{{asset('public/frontend/assets/css/style.css')}}" />
            <link rel="stylesheet" href="{{asset('public/frontend/assets/css/responsive.css')}}" />
        @endif

    </head>
    <style>
        .kinetic
        {
            position: relative;
        }

        .kinetic::after,
        .kinetic::before
        {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border: 50px solid transparent;
            border-bottom-color: rgb(0, 0, 0);
            animation: rotateA 2s linear infinite .5s;
        }

        .kinetic::before
        {
            transform: rotate(90deg);
            animation: rotateB 2s linear infinite;
        }

        @keyframes rotateA {
            0%, 25% {
                transform: rotate(0deg);
            }

            50%, 75% {
                transform: rotate(180deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes rotateB {
            0%, 25% {
                transform: rotate(90deg);
            }

            50%, 75% {
                transform: rotate(270deg);
            }

            100% {
                transform: rotate(450deg);
            }
        }
    </style>
    <body>
        @include('frontend.layouts.header')
           @yield('content')
        @include('frontend.layouts.footer')
    </body>

</html>
