
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
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/responsive.css')}}" />

    <!-- Background css -->
    <link rel="stylesheet" id="bg-switcher-css" href="{{asset('public/frontend/assets/css/backgrounds/bg-4.css')}}">

</head>
<body class="terms_condition_page">
    <div id="ec-overlay"><span class="loader_img"></span></div>

    <!-- Header start  -->
    @include('frontend.layouts.header')
    <!-- Header End  -->

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Policy</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="ec-breadcrumb-item active">Policy</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Start Privacy & Policy page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Privacy & Policy</h2>
                        <h2 class="ec-title">Privacy & Policy</h2>
                        <p class="sub-title mb-3">Welcome to the ekka multivendor marketplace</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="ec-common-wrapper">
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Welcome to Ekka Multi Market.</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <b>Lorem
                                        Ipsum is simply dutmmy text</b> ever since the 1500s, when an unknown printer
                                    took a galley of type and scrambled it to make a type specimen book. It has survived
                                    not only five centuries, but also the leap into electronic typesetting, remaining
                                    essentially unchanged. <b>Lorem Ipsum is simply dutmmy text</b></p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Ekka Websites</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <b>Lorem
                                        Ipsum is simply dutmmy text</b> ever since the 1500s, when an unknown printer
                                    took a galley of type and scrambled it to make a type specimen book. It has survived
                                    not only five centuries, but also the leap into electronic typesetting, remaining
                                    essentially unchanged. <b>Lorem Ipsum is simply dutmmy text</b></p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">How browsing and vendor works?</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <b>Lorem
                                        Ipsum is simply dutmmy text</b> ever since the 1500s, when an unknown printer
                                    took a galley of type and scrambled it to make a type specimen book. It has survived
                                    not only five centuries, but also the leap into electronic typesetting, remaining
                                    essentially unchanged. <b>Lorem Ipsum is simply dutmmy text</b></p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Becoming an vendor</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <b>Lorem
                                        Ipsum is simply dutmmy text</b> ever since the 1500s, when an unknown printer
                                    took a galley of type and scrambled it to make a type specimen book. It has survived
                                    not only five centuries, but also the leap into electronic typesetting, remaining
                                    essentially unchanged. <b>Lorem Ipsum is simply dutmmy text</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Privacy & Policy page -->

    <!-- Footer Start -->
    @include('frontend.layouts.footer')
    <!-- Footer Area End -->

    <!-- Vendor JS -->
    <script src="{{asset('public/frontend/assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('public/frontend/assets/js/vendor/jquery.notify.min.js')}}"></script>
	<script src="{{asset('public/frontend/assets/js/vendor/jquery.bundle.notify.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>

    <!--Plugins JS-->
    <script src="{{asset('public/frontend/assets/js/plugins/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/plugins/countdownTimer.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/plugins/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/plugins/slick.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/plugins/infiniteslidev2.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/plugins/jquery.sticky-sidebar.js')}}"></script>
    <!-- Google translate Js -->
    <script src="{{asset('public/frontend/assets/js/vendor/google-translate.js')}}"></script>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
        }
    </script>
    <!-- Main Js -->
    <script src="{{asset('public/frontend/assets/js/vendor/index.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/main.js')}}"></script>

</body>
</html>
