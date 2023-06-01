@php
    $phone = App\Models\Admin\WebsiteSetting::where('type', 'phone')->first();
@endphp
<header class="ec-header">
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 header-top-left">
                    <div class="header-top-social nav-style-separated">
                        <ul class="mb-0 ">
                            <li class="list-inline-item">
                                <div class="header-top-call ">
                                    <a href="#">Indian Dresses Online Shopping - Sarees, Salwar Kameez, Lehenga Cholis, Kurtis</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 header-top-right">
                    <div class="header-top-right-inner d-flex justify-content-end">
                        <div class="header-top-social">
                            <ul class="mb-0">
                                <li class="list-inline-item">
                                    <div class="header-top-call">
                                        <i class="ecicon eci-volume-control-phone"></i>
                                        <a href="tel:+ {{ optional($phone)->image }}"> +91-
                                            {{ optional($phone)->image }}</a>
                                    </div>
                                </li>
                                <li class="list-inline-item d-none d-lg-block">
                                    <div class="header-top-call">
                                        <i class="ecicon eci-truck"></i>
                                        <a href="#"> Track Order</a>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="header-top-call">
                                        <i class="ecicon eci-headphones"></i>
                                        <a href="tel:+91-{{ optional($phone)->image }}"> Help Center</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col header-top-res d-lg-none">
                    <div class="ec-header-bottons">
                        <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                            <i class="ecicon eci-bars"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="header-bottom-flex">
                    <div class="align-self-center ec-header-logo ">
                        <div class="header-logo">
                            @php
                                $logo = App\Models\Admin\WebsiteSetting::where('type', 'logo')->first();
                            @endphp
                            <a href="{{ route('index') }}">
                                <img src="{{ asset('public/' . api_asset(optional($logo)->image)) }}" alt="Site Logo" />
                                <img class="dark-logo" src="{{ asset('public/' . api_asset(optional($logo)->image)) }}"
                                    alt="Site Logo" style="display: none;" />
                            </a>
                        </div>
                    </div>
                    <div class="align-self-center ec-header-search">
                        <div class="header-search">
                            <form class="ec-search-group-form" action="{{ route('product-search') }}" method="GET"
                                autocomplete="off">
                                <input class="form-control flip" name="search" value="{{ request()->search }}"
                                    placeholder="I’m searching for..." type="text" id="flip"
                                    onkeyup="searchs()">
                                <button class="search_submit" type="submit">
                                    <img src="{{ asset('public/frontend/assets/images/icons/search.svg') }}"
                                        class="svg_img search_svg" alt="" />
                                </button>
                            </form>
                            <div class="TopSearchesBox searchRes" style="display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="align-self-center ec-header-cart">
                        <div class="ec-header-bottons">
                            <!-- Header User Start -->
                            @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                                <div class="ec-header-user dropdown">
                                    <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                            src="{{ asset('public/frontend/assets/images/icons/user.svg') }}"
                                            class="svg_img header_svg" alt="" /><span
                                            class="ec-btn-title">Account</span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if (Auth::guard('customer')->check())
                                            <li><a class="dropdown-item" href="{{ route('user_profile') }}">Profile</a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ route('checkout') }}">Checkout</a></li>
                                            <li><a class="dropdown-item" href="{{ route('customer.logout') }}">Logout</a>
                                            </li>
                                        @else
                                            @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                                            <li><a class="dropdown-item" href="{{ route('user.login') }}">Login</a></li>
                                            @endif
                                            @if(featureActivation('retailer') == '1')
                                            <li><a class="dropdown-item" href="{{ route('user.register') }}">User Register</a>
                                            </li>
                                            @endif
                                            @if(featureActivation('mlm') == '1')
                                            <li><a class="dropdown-item" href="{{ route('user.register.mlm') }}">Mlm Register</a>
                                            </li>
                                            @endif
                                            @if(featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                                            <li><a class="dropdown-item"
                                                    href="{{ route('business.person.request.form') }}">Dealer Register</a>
                                            </li>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            @endif
                            <a href="{{ route('wishlist') }}" class="ec-header-btn ec-header-wishlist">
                                <div class="header-icon">
                                    <img src="{{ asset('public/frontend/assets/images/icons/wishlist.svg') }}"
                                        class="svg_img header_svg" alt="" />
                                </div>
                                <span class="ec-header-count ec-cart-wishlist">0</span>
                                <span class="ec-btn-title">wishlist</span>
                            </a>
                            <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                                <div class="header-icon">
                                    <img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}"
                                        class="svg_img header_svg" alt="" />
                                </div>
                                <span class="ec-header-count ec-cart-count header_cart_count">
                                    @if (Auth::guard('customer')->check())
                                        {{ App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)->get()->count() }}
                                    @else
                                        0
                                    @endif
                                </span>
                                <span class="ec-btn-title">In Cart</span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Header Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row ">
                <div class="col">
                    <div class="header-logo">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('public/' . api_asset(optional($logo)->image)) }}" alt="Site Logo" />
                            <img class="dark-logo" src="{{ asset('public/' . api_asset(optional($logo)->image)) }}"
                                alt="Site Logo" style="display: none;" />
                        </a>
                    </div>
                </div>
                <div class="col align-self-center ec-header-search">
                    <div class="header-search">
                        <form class="ec-search-group-form" action="{{ route('product-search') }}" method="GET"
                            autocomplete="off">
                            <input class="form-control flip" name="search" value="{{ request()->search }}"
                                placeholder="I’m searching for..." type="text" id="flip"
                                onkeyup="searchs()">
                            <button class="search_submit" type="submit">
                                <img src="{{ asset('public/frontend/assets/images/icons/search.svg') }}"
                                    class="svg_img search_svg" alt="" />
                            </button>
                        </form>
                        <div class="TopSearchesBox searchRes" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Header End -->

    <div id="ec-main-menu-desk" class="sticky-nav">
        <div class="container position-relative">
            <div class="row">
                <div class="col-sm-12 ec-main-menu-block align-self-center d-none d-lg-block">
                    <div class="ec-main-menu">
                        <ul>
                            <li>
                                <a href="{{ route('index') }}">Home</a>
                            </li>
                            @foreach (App\Models\Admin\Category::where('is_active', 1)->orderby('nav_priority', 'asc')->take(9)->get() as $header_category)
                                @php
                                    $sub_cats = App\Models\Admin\SubSubCategory::where('is_active', 1)
                                        ->whereJsonContains('category_id', '' . $header_category->id)
                                        ->get();
                                @endphp
                                @if (count($sub_cats))
                                    <li class="dropdown position-static">
                                        <a
                                            href="{{ route('search', $header_category->slug) }}?type=category">{{ $header_category->name }}</a>
                                        <ul class="mega-menu d-block">
                                            <li class="d-flex">
                                                @foreach (App\Models\Admin\SubCategory::where('is_active', 1)->whereJsonContains('category_id', '' . $header_category->id)->get() as $header_subcategory)
                                                    <ul class="d-block">
                                                        <li class="menu_title"><a
                                                                href="{{ route('search', $header_subcategory->slug) }}?type=subcategory">{{ $header_subcategory->name }}</a>
                                                        </li>
                                                        @foreach (App\Models\Admin\SubSubCategory::where('is_active', 1)->whereJsonContains('subcategory_id', '' . $header_subcategory->id)->get() as $header_subsubcategory)
                                                            <li><a
                                                                    href="{{ route('search', $header_subsubcategory->slug) }}?type=subsubcategory">{{ $header_subsubcategory->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endforeach
                                                <ul class="d-block">
                                                    <img src="{{ asset('public/' . api_asset($header_category->icon)) }}"
                                                        alt="product">
                                                </ul>
                                            </li>

                                        </ul>
                                    </li>
                                @else
                                    <li class="dropdown"><a
                                            href="{{ route('search', $header_category->slug) }}?type=category">{{ $header_category->name }}</a>
                                        <ul class="sub-menu">
                                            @foreach (App\Models\Admin\SubCategory::where('is_active', 1)->whereJsonContains('category_id', '' . $header_category->id)->get() as $header_subcategory)
                                                <li><a
                                                        href="{{ route('search', $header_subcategory->slug) }}?type=subcategory">{{ $header_subcategory->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach

                            <li class="dropdown"><a href="javascript:void(0)">Info</a>
                                <ul class="sub-menu">

                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>

                {{-- <div class="col-sm-3 ec-category-block">
                    <div class="ec-category-menu">
                        <div class="ec-category-toggle"><span class="ec-category-title">Download Brochure</span><i class="ecicon eci-angle-down" aria-hidden="true"></i>
                        </div>
                        <div class="ec-category-content">
                            <div id="ec-category-menu" class="ec-category-menu" style="display: none;">
                                <ul class="ec-category-wrapper">
                                    <li><a title="" class="ec-cat-menu-link" href="{{asset('public/frontend/assets/pdf/koina craft.pdf')}}" target="_blank" download>Koina Craft</a></li>
                                    <li><a title="" class="ec-cat-menu-link" href="{{asset('public/frontend/assets/pdf/koina premium.pdf')}}" target="_blank" download>Koina Premium</a></li>
                                    <li><a title="" class="ec-cat-menu-link" href="{{asset('public/frontend/assets/pdf/koina regular.pdf')}}" target="_blank" download>Koina Regular</a></li>
                                    <li><a title="" class="ec-cat-menu-link" href="{{asset('public/frontend/assets/pdf/koina sofa.pdf')}}" target="_blank" download>Koina Sofa</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">My Menu</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <ul>
                    <li><a href="{{ route('index') }}">Home</a></li>

                    {{-- <li>
                        <a href="javascript:void(0)">Categories</a>
                        <ul class="sub-menu">
                            @foreach (App\Models\Admin\Category::where('is_active', 1)->orderby('nav_priority', 'asc')->take(9)->get() as $mob_header_category)
                                <li>
                                    <a href="javascript:void(0)">{{$mob_header_category->name}}</a>
                                    <ul class="sub-menu">
                                        @foreach (App\Models\Admin\SubCategory::where('is_active', 1)->whereJsonContains('category_id', '' . $mob_header_category->id)->get() as $mob_header_subcategory)
                                            <li><a href="{{ route('search',$mob_header_subcategory->slug) }}?type=subcategory">{{$mob_header_subcategory->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li> --}}

                    @foreach (App\Models\Admin\Category::where('is_active', 1)->orderby('nav_priority', 'asc')->take(9)->get() as $mob_header_category)
                        <li><a href="javascript:void(0)">{{ $mob_header_category->name }}</a>
                            <ul class="sub-menu">
                                @foreach (App\Models\Admin\SubCategory::where('is_active', 1)->whereJsonContains('category_id', '' . $mob_header_category->id)->get() as $mob_header_subcategory)
                                    <li><a
                                            href="{{ route('search', $mob_header_subcategory->slug) }}?type=subcategory">{{ $mob_header_subcategory->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach

                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="header-res-lan-curr">
                <div class="header-res-social">
                    <div class="header-top-social">
                        <ul class="mb-0">
                            <li class="list-inline-item"><a class="hdr-facebook" href="#"><i
                                        class="ecicon eci-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-twitter" href="#"><i
                                        class="ecicon eci-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-instagram" href="#"><i
                                        class="ecicon eci-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i
                                        class="ecicon eci-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="ec-side-cart-overlay"></div>
<div id="ec-side-cart" class="ec-side-cart">
    @include('frontend.cart_detail')
</div>

<script>
    function searchs() {
        var search_val = $('.flip').val();
        $.ajax({
            type: 'GET',
            url: "{{ route('product-search') }}?search=" + search_val,
            success: function(data) {
                $(".searchRes").html(data);
                $(".searchRes").css("display", "block");
            }
        });
    }

    $(document).ready(function() {
        $(".flip").click(function() {
            var search_val = $('.flip').val();
            $.ajax({
                type: 'GET',
                url: "{{ route('product-search') }}?search=" + search_val,
                success: function(data) {
                    $(".searchRes").html(data);
                    $(".searchRes").slideToggle("slow");
                }
            });
        });
    });

    function remove_to_cart(cart_id) {
        $.ajax({
            type: 'GET',
            url: "{{ route('delete.to.cart', '') }}/" + cart_id,
            success: function(data) {
                $('#ec-side-cart').html(data)
            }
        });
    }
</script>
