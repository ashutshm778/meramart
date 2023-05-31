@extends('frontend.layouts.app')
@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Compare</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Compare</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Compare page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Start -->
                <div class="ec-compare-leftside col-lg-3 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <div class="ec-sidebar-block">
                            <div class="ec-sidebar-block-item">
                                <h5 class="ec-compare-title">Product <br>Specifications</h5>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Sidebar end -->
                <!-- Compare Content Start -->
                <div class="ec-compare-rightside col-lg-9 col-md-12">
                    <!-- Compare content Start -->
                    <div class="ec-compare-content">
                        <div class="ec-compare-inner">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content prod-1">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="product-left-sidebar.html" class="image">
                                                    <img class="main-image"
                                                        src="{{asset('public/frontend/assets/images/product-image/7_1.jpg')}}" alt="Product" />
                                                    <img class="hover-image"
                                                        src="{{asset('public/frontend/assets/images/product-image/7_2.jpg')}}" alt="Product" />
                                                </a>
                                                <span class="ec-com-remove ec-remove-compare"><a href="javascript:void(0)">×</a></span>
                                                <span class="percentage">20%</span>
                                                <a href="#" class="quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#ec_quickview_modal"><img
                                                        src="{{asset('public/frontend/assets/images/icons/quickview.svg')}}" class="svg_img pro_svg"
                                                        alt="" /></a>
                                                <div class="ec-pro-actions">
                                                    <a href="compare.html" class="ec-btn-group compare"
                                                        title="Compare"><img src="{{asset('public/frontend/assets/images/icons/compare.svg')}}"
                                                            class="svg_img pro_svg" alt="" /></a>
                                                    <button title="Add To Cart" class=" add-to-cart"><img
                                                            src="{{asset('public/frontend/assets/images/icons/cart.svg')}}" class="svg_img pro_svg"
                                                            alt="" /> Add To Cart</button>
                                                    <a class="ec-btn-group wishlist" title="Wishlist"><img
                                                            src="{{asset('public/frontend/assets/images/icons/wishlist.svg')}}"
                                                            class="svg_img pro_svg" alt="" /></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Full Sleeve Shirt</a></h5>
                                            <div class="ec-pro-rating">
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star"></i>
                                            </div>
                                            <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dutmmy text ever since the 1500s, when an unknown printer took a galley.</div>
                                            <span class="ec-price">
                                                <span class="old-price">$12.00</span>
                                                <span class="new-price">$10.00</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                                data-src="{{asset('public/frontend/assets/images/product-image/7_1.jpg')}}"
                                                                data-src-hover="{{asset('public/frontend/assets/images/product-image/7_1.jpg')}}"
                                                                data-tooltip="Gray"><span
                                                                    style="background-color:#01f1f1;"></span></a></li>
                                                        <li><a href="#" class="ec-opt-clr-img"
                                                                data-src="{{asset('public/frontend/assets/images/product-image/7_2.jpg')}}"
                                                                data-src-hover="{{asset('public/frontend/assets/images/product-image/7_2.jpg')}}"
                                                                data-tooltip="Orange"><span
                                                                    style="background-color:#b89df8;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li class="active"><a href="#" class="ec-opt-sz"
                                                                data-old="$12.00" data-new="$10.00"
                                                                data-tooltip="Small">S</a></li>
                                                        <li><a href="#" class="ec-opt-sz" data-old="$15.00"
                                                                data-new="$12.00" data-tooltip="Medium">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz" data-old="$20.00"
                                                                data-new="$17.00" data-tooltip="Extra Large">XL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content prod-1">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="product-left-sidebar.html" class="image">
                                                    <img class="main-image"
                                                        src="{{asset('public/frontend/assets/images/product-image/1_1.jpg')}}" alt="Product" />
                                                    <img class="hover-image"
                                                        src="{{asset('public/frontend/assets/images/product-image/1_2.jpg')}}" alt="Product" />
                                                </a>
                                                <span class="ec-com-remove ec-remove-compare"><a href="javascript:void(0)">×</a></span>
                                                <span class="percentage">20%</span>
                                                <a href="#" class="quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#ec_quickview_modal"><img
                                                        src="{{asset('public/frontend/assets/images/icons/quickview.svg')}}" class="svg_img pro_svg"
                                                        alt="" /></a>
                                                <div class="ec-pro-actions">
                                                    <a href="compare.html" class="ec-btn-group compare"
                                                        title="Compare"><img src="{{asset('public/frontend/assets/images/icons/compare.svg')}}"
                                                            class="svg_img pro_svg" alt="" /></a>
                                                    <button title="Add To Cart" class=" add-to-cart"><img
                                                            src="{{asset('public/frontend/assets/images/icons/cart.svg')}}" class="svg_img pro_svg"
                                                            alt="" /> Add To Cart</button>
                                                    <a class="ec-btn-group wishlist" title="Wishlist"><img
                                                            src="{{asset('public/frontend/assets/images/icons/wishlist.svg')}}"
                                                            class="svg_img pro_svg" alt="" /></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Cute Baby Toy's</a></h5>
                                            <div class="ec-pro-rating">
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star"></i>
                                            </div>
                                            <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dutmmy text ever since the 1500s, when an unknown printer took a galley.</div>
                                            <span class="ec-price">
                                                <span class="old-price">$40.00</span>
                                                <span class="new-price">$30.00</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                                data-src="{{asset('public/frontend/assets/images/product-image/1_1.jpg')}}"
                                                                data-src-hover="{{asset('public/frontend/assets/images/product-image/1_1.jpg')}}"
                                                                data-tooltip="Gray"><span
                                                                    style="background-color:#90cdf7;"></span></a></li>
                                                        <li><a href="#" class="ec-opt-clr-img"
                                                                data-src="{{asset('public/frontend/assets/images/product-image/1_2.jpg')}}"
                                                                data-src-hover="{{asset('public/frontend/assets/images/product-image/1_2.jpg')}}"
                                                                data-tooltip="Orange"><span
                                                                    style="background-color:#ff3b66;"></span></a></li>
                                                        <li><a href="#" class="ec-opt-clr-img"
                                                                data-src="{{asset('public/frontend/assets/images/product-image/1_3.jpg')}}"
                                                                data-src-hover="{{asset('public/frontend/assets/images/product-image/1_3.jpg')}}"
                                                                data-tooltip="Green"><span
                                                                    style="background-color:#ffc476;"></span></a></li>
                                                        <li><a href="#" class="ec-opt-clr-img"
                                                                data-src="{{asset('public/frontend/assets/images/product-image/1_4.jpg')}}"
                                                                data-src-hover="{{asset('public/frontend/assets/images/product-image/1_4.jpg')}}"
                                                                data-tooltip="Sky Blue"><span
                                                                    style="background-color:#1af0ba;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li class="active"><a href="#" class="ec-opt-sz"
                                                                data-old="$40.00" data-new="$30.00"
                                                                data-tooltip="Small">S</a></li>
                                                        <li><a href="#" class="ec-opt-sz" data-old="$50.00"
                                                                data-new="$40.00" data-tooltip="Medium">M</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content prod-1">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="product-left-sidebar.html" class="image">
                                                    <img class="main-image"
                                                        src="{{asset('public/frontend/assets/images/product-image/2_1.jpg')}}" alt="Product" />
                                                    <img class="hover-image"
                                                        src="{{asset('public/frontend/assets/images/product-image/2_2.jpg')}}" alt="Product" />
                                                </a>
                                                <span class="ec-com-remove ec-remove-compare"><a href="javascript:void(0)">×</a></span>
                                                <span class="percentage">20%</span>
                                                <a href="#" class="quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#ec_quickview_modal"><img
                                                        src="{{asset('public/frontend/assets/images/icons/quickview.svg')}}" class="svg_img pro_svg"
                                                        alt="" /></a>
                                                <div class="ec-pro-actions">
                                                    <a href="compare.html" class="ec-btn-group compare"
                                                        title="Compare"><img src="{{asset('public/frontend/assets/images/icons/compare.svg')}}"
                                                            class="svg_img pro_svg" alt="" /></a>
                                                    <button title="Add To Cart" class=" add-to-cart"><img
                                                            src="{{asset('public/frontend/assets/images/icons/cart.svg')}}" class="svg_img pro_svg"
                                                            alt="" /> Add To Cart</button>
                                                    <a class="ec-btn-group wishlist" title="Wishlist"><img
                                                            src="{{asset('public/frontend/assets/images/icons/wishlist.svg')}}"
                                                            class="svg_img pro_svg" alt="" /></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Jumbo Carry Bag</a></h5>
                                            <div class="ec-pro-rating">
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star"></i>
                                            </div>
                                            <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dutmmy text ever since the 1500s, when an unknown printer took a galley.</div>
                                            <span class="ec-price">
                                                <span class="old-price">$50.00</span>
                                                <span class="new-price">$40.00</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                                data-src="{{asset('public/frontend/assets/images/product-image/2_1.jpg')}}"
                                                                data-src-hover="{{asset('public/frontend/assets/images/product-image/2_2.jpg')}}"
                                                                data-tooltip="Gray"><span
                                                                    style="background-color:#fdbf04;"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--compare content End -->
                </div>
                <!-- Compare Content end -->
                <div class="ec-compare-table col-md-12">
                    <div class="ec-com-tab-heading">Show Only Difference</div>
                    <form action="#">
                        <!-- Compare Table -->
                        <div class="compare-table table-responsive">
                            <table class="table mb-0">

                                <tbody>
                                    <tr>
                                        <td class="first-column">Name</td>
                                        <td class="prod-1">Man Shirt</td>
                                        <td class="prod-2">Baby Dress</td>
                                        <td class="prod-3">Bag</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Availability</td>
                                        <td class="prod-1">In Stock</td>
                                        <td class="prod-2">Out Of Stock</td>
                                        <td class="prod-3">In Stock</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">location</td>
                                        <td class="prod-1">In Store , Online</td>
                                        <td class="prod-2">In Store</td>
                                        <td class="prod-3">Online</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">customization</td>
                                        <td class="prod-1">In Stock</td>
                                        <td class="prod-2">Stock</td>
                                        <td class="prod-3">In Stock</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Brand</td>
                                        <td class="prod-1">Gucci</td>
                                        <td class="prod-2">Hermes</td>
                                        <td class="prod-3">Prada</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">SKU</td>
                                        <td class="prod-1">21704</td>
                                        <td class="prod-2">21220</td>
                                        <td class="prod-3">21207</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @endsection
