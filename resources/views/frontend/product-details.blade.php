@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">{{ $data->name }}</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="ec-breadcrumb-item active">Products</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Sart Single product -->

    <section class="ec-page-content section-space-p">

        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">

                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner" id="product_variant_div">
                            @include('frontend.product_variant')
                        </div>
                    </div>
                    <!--Single product content End -->

                    <!-- Single product tab start -->
                    <div class="ec-single-pro-tab">
                        <div class="ec-single-pro-tab-wrapper">
                            <div class="ec-single-pro-tab-nav">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details"
                                            role="tablist">Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info"
                                            role="tablist">More Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review"
                                            role="tablist">Reviews</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content  ec-single-pro-tab-content">
                                <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                    <div class="ec-single-pro-tab-desc">
                                        {!! $data->description !!}
                                    </div>
                                </div>
                                <div id="ec-spt-nav-info" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-moreinfo">
                                        {!! $data->specification !!}
                                    </div>
                                </div>

                                <div id="ec-spt-nav-review" class="tab-pane fade">
                                    <div class="row">
                                        <div class="ec-t-review-wrapper">
                                            <div class="ec-t-review-item">
                                                <div class="ec-t-review-avtar">
                                                    <img src="{{ asset('public/frontend/assets/images/review-image/1.jpg') }}"
                                                        alt="" />
                                                </div>
                                                <div class="ec-t-review-content">
                                                    <div class="ec-t-review-top">
                                                        <div class="ec-t-review-name">Jeny Doe</div>
                                                        <div class="ec-t-review-rating">
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ec-t-review-bottom">
                                                        <p>... </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-ratting-content">
                                            <h3>Add a Review</h3>
                                            <div class="ec-ratting-form">
                                                <form action="#">
                                                    <div class="ec-ratting-star">
                                                        <span>Your rating:</span>
                                                        <div class="ec-t-review-rating">
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star-o"></i>
                                                            <i class="ecicon eci-star-o"></i>
                                                            <i class="ecicon eci-star-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="ec-ratting-input">
                                                                <input name="your-name" placeholder="Name" type="text" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="ec-ratting-input">
                                                                <input name="your-email" placeholder="Email*" type="email"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="ec-ratting-input form-submit">
                                                        <textarea name="your-commemt" placeholder="Enter Your Comment"></textarea>
                                                        <button class="btn btn-primary" type="submit"
                                                            value="Submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details description area end -->
                </div>

            </div>
        </div>

    </section>
    <!-- End Single product -->

    <!-- Related Product Start -->
    <section class="section ec-releted-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Related products</h2>
                        <h2 class="ec-title">Related products</h2>
                        <p class="sub-title"></p>
                    </div>
                </div>
            </div>
            <div class="row margin-minus-b-30">
                <!-- Related Product Content -->
                {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="#" class="image">
                                    <img class="main-image"
                                        src="{{ asset('public/frontend/assets/images/product-image/22_1.jpg') }}"
                                        alt="Product" />
                                    <img class="hover-image"
                                        src="{{ asset('public/frontend/assets/images/product-image/22_2.jpg') }}"
                                        alt="Product" />
                                </a>
                                <span class="percentage">0%</span>
                                <div class="ec-pro-actions">
                                    <a class="ec-btn-group wishlist" title="Wishlist"><img
                                            src="{{ asset('public/frontend/assets/images/icons/wishlist.svg') }}"
                                            class="svg_img pro_svg" alt="" /></a>
                                </div>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="#">Modern tabel for living
                                    room</a></h5>
                            <div class="ec-pro-rating">
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star"></i>
                            </div>
                            <div class="ec-pro-list-desc">...</div>
                            <span class="ec-price">
                                <span class="old-price">0.00</span>
                                <span class="new-price">0.00</span>
                            </span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <script src="{{ asset('public/frontend/assets/js/zoom-image.js') }}"></script>
    <script type="text/javascript">
        if (window.innerWidth > 768) {
            $('.imgBox').imgZoom({
                boxWidth: 500,
                boxHeight: 500,
                marginLeft: 5,
                origin: 'data-origin'
            });
        }

        $(document).ready(function() {
            $('.show-small-img').click(function() {
                $('#show-img').attr('data-origin', $(this).attr('src'));
            });
        });



        function getVaiantPriceData(product_group_id,attribute_id,attribute_value){
            var quanity=$('#quantity').val();
            $.ajax({
                type: "GET",
                url: '{{ route('product.get_varinat_price_data') }}',
                data: {
                    product_group_id:product_group_id,
                    attribute_id:attribute_id,
                    attribute_value:attribute_value,
                    product_qty:quanity
                },
                success: function(data) {

                        $('#product_variant_div').empty();
                        $('#product_variant_div').html(data);
                        $(".single-product-cover").slick({
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: !1,
                                fade: !1,
                                asNavFor: ".single-nav-thumb"
                            }),
                            $(".single-nav-thumb").slick({
                                slidesToShow: 4,
                                slidesToScroll: 1,
                                asNavFor: ".single-product-cover",
                                focusOnSelect: !0,
                            })
                }
            });
        }

        function getVaiantPriceColorData(product_group_id,color){
            var quanity=$('#quantity').val();
            $.ajax({
                type: "GET",
                url: '{{ route('product.get_varinat_price_data') }}',
                data: {
                    product_group_id:product_group_id,
                    color:color,
                    product_qty:quanity
                },
                success: function(data) {

                        $('#product_variant_div').empty();
                        $('#product_variant_div').html(data);
                        $(".single-product-cover").slick({
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: !1,
                                fade: !1,
                                asNavFor: ".single-nav-thumb"
                            }),
                            $(".single-nav-thumb").slick({
                                slidesToShow: 4,
                                slidesToScroll: 1,
                                asNavFor: ".single-product-cover",
                                focusOnSelect: !0,
                            })
                }
            });
        }


        $(document).ready(function() {
            getVariantPrice();
        });
    </script>

    {{-- <script src="{{asset('public/frontend/assets/js/zoom-main.js')}}"></script> --}}

    </section>
@endsection
