<footer class="ec-footer">
    <div class="footer-container">
        {{-- <div class="footer-offer">
            <div class="container">
                <div class="row">
                    <div class="text-center footer-off-msg">
                        <span>Win a contest! Get this limited-editon</span><span class="footer-off-text">- Free Office Chair</span><a href="#" target="_blank">View Detail</a>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="footer-top section-space-footer-p">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-4 ec-footer-contact">
                        <div class="ec-footer-widget">
                            <div class="box-contact">
                                @php
                                    $phone = App\Models\Admin\WebsiteSetting::where('type', 'phone')->first();
                                @endphp
                                @if (!empty($phone))
                                    <div class="box-phone">
                                        <i class="ecicon eci-mobile-phone"></i>
                                        <div class="content">
                                            <h2>CALL US FREE</h2>
                                            {{ optional($phone)->image }}
                                        </div>
                                    </div>
                                @endif
                                @php
                                    $footer_description = App\Models\Admin\WebsiteSetting::where('type', 'footer_description')->first();
                                @endphp
                                {!! optional($footer_description)->image !!}
                                <ul>
                                    @php
                                        $address = App\Models\Admin\WebsiteSetting::where('type', 'address')->first();
                                    @endphp
                                    <li><i class="ecicon eci-map-marker"></i>{{ optional($address)->image }}</li>
                                    @php
                                        $email = App\Models\Admin\WebsiteSetting::where('type', 'email')->first();
                                    @endphp
                                    <li><i class="ecicon eci-envelope-o"></i>{{ optional($email)->image }}</li>
                                    <li><i class="ecicon eci-volume-control-phone"></i> {{ optional($phone)->image }}
                                    </li>
                                </ul>
                            </div>

                            {{-- <h4 class="ec-footer-heading">Location</h4> --}}
                            {{-- <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link">Varanasi, Uttar Pradesh, India (221010)</li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-news">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Our Company </h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="#">About Us</a></li>
                                    <li class="ec-footer-link"><a href="#">Career</a></li>
                                    <li class="ec-footer-link"><a href="#">Blog</a></li>
                                    <li class="ec-footer-link"><a href="#">Customer Stories</a></li>
                                    <li class="ec-footer-link"><a href="#">Our Stores</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-account">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Useful Links</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="#">Exporters</a></li>
                                    <li class="ec-footer-link"><a href="#">Buy in Bulk</a></li>
                                    <li class="ec-footer-link"><a href="#">Refer & Earn</a></li>
                                    <li class="ec-footer-link"><a href="#">Delivery Location</a></li>
                                    <li class="ec-footer-link"><a href="#">Sitemap</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-account">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">My Account</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="#">Login</a></li>
                                    <li class="ec-footer-link"><a href="#">Order History</a></li>
                                    <li class="ec-footer-link"><a href="#">My Wishlist</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-service">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Our Policies</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="#">Discount Returns</a></li>
                                    <li class="ec-footer-link"><a href="#">Policy & policy </a></li>
                                    <li class="ec-footer-link"><a href="#">Customer Service</a></li>
                                    <li class="ec-footer-link"><a href="#">Term & condition</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-8 footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy">Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> All Rights Reserved. Developed By <a href="#"
                                    class="site-name"> Techup Technologies. </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 footer-bottom-right">
                        <div class="footer-bottom-payment d-flex justify-content-end">
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="list-inline-item"><a href="#" class="prt-social-facebook"><i
                                                class="ecicon eci-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="#" class="prt-social-twitter"><i
                                                class="ecicon eci-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#" class="prt-social-instagram"><i
                                                class="ecicon eci-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#" class="prt-social-linkedin"><i
                                                class="ecicon eci-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="ec-nav-toolbar">
    <div class="container">
        <div class="ec-nav-panel">
            <div class="ec-nav-panel-icons">
                <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle">
                    <img src="{{ asset('public/frontend/assets/images/icons/menu.svg') }}" class="svg_img header_svg"
                        alt="" />
                </a>
            </div>
            <div class="ec-nav-panel-icons">

                <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle">
                    <img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}" class="svg_img header_svg"
                        alt="" />

                    <span class="ec-cart-noti ec-header-count cart-count-lable">

                        @if (Auth::guard('customer')->check())
                            {{ App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)->get()->count() }}
                        @else
                            0
                        @endif
                    </span>

                </a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{ route('index') }}" class="ec-header-btn">
                    <img src="{{ asset('public/frontend/assets/images/icons/home.svg') }}" class="svg_img header_svg"
                        alt="icon" />
                </a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{ route('wishlist') }}" class="ec-header-btn">
                    <img src="{{ asset('public/frontend/assets/images/icons/wishlist.svg') }}"
                        class="svg_img header_svg" alt="icon" />
                    <span class="ec-cart-noti">0</span>
                </a>
            </div>
            <div class="ec-nav-panel-icons">
                @if (Auth::guard('customer')->check())
                    <a href="{{ route('user_profile') }}" class="ec-header-btn">
                        <img src="{{ asset('public/frontend/assets/images/icons/user.svg') }}"
                            class="svg_img header_svg" alt="icon" />

                    </a>
                @else
                    @if (featureActivation('retailer') == '1' ||
                            featureActivation('distributor') == '1' ||
                            featureActivation('wholeseller') == '1')
                        <a href="{{ route('user.login') }}" class="ec-header-btn">
                            <img src="{{ asset('public/frontend/assets/images/icons/user.svg') }}"
                                class="svg_img header_svg" alt="icon" />
                        </a>
                    @endif
                @endif
            </div>

        </div>
    </div>
</div>

{{-- <div class="ec-right-bottom">
    <div class="ec-box">
        <div class="ec-button rotateBackward">
            <a href="https://wa.me/+917307098502" target="_blank"> <img
                    src="{{ asset('public/frontend/assets/images/whatsapp.png') }}" alt="whatsapp icon"></a>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="ec_quickview_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="modal_body">
            </div>
        </div>
    </div>
</div>
<div id="addtocart_toast" class="addtocart_toast">
    <div class="desc">You Have Add To Cart Successfully</div>
</div>
<div id="wishlist_toast" class="wishlist_toast">
    <div class="desc">You Have Add To Wishlist Successfully</div>
</div>
<style>
    .bs-modal-sm {
        width: 600px !important;
    }
</style>
<div class="modal fade" id="login_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog bs-modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="modal_body">
                <div class="ec-register-wrapper">
                    <div class="ec-register-container">
                        <div class="ec-register-form">
                            <h2>Login</h2>
                            <form id="valid_form" action="{{ route('customer.login') }}" method="post">
                                @csrf
                                <span class="ec-register-wrap col-md-12">
                                    <label>Phone Number<span style="color:red">*<span></label> <br>
                                    <input type="number" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') }}" placeholder="" required>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap col-md-12">
                                    <label>Password<span style="color:red">*<span></label> <br>
                                    <input type="password" id="pasword" class="form-control" name="password"
                                        placeholder="" required />
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap ec-register-btn">
                                    <button class="btn btn-primary mt-4" type="submit">Login</button>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mt-2">Don't have an account ? <a
                                                    href="{{ route('user.register.mlm') }}"> Register</a></p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <p class="mt-2">Forget Password ? <a
                                                    href="{{ route('customer.forgot_password') }}"> Click Here</a></p>
                                        </div>
                                    </div>
                                </span>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <!-- Recent Purchase Popup  -->
    <div class="recent-purchase">
        <img src="{{asset('public/frontend/assets/images/product-image/1.jpg')}}" alt="payment image">
        <div class="detail">
            <p>Someone in new just bought</p>
            <h6>stylish baby shoes</h6>
            <p>10 Minutes ago</p>
        </div>
        <a href="javascript:void(0)" class="icon-btn recent-close">×</a>
    </div>
    <!-- Recent Purchase Popup end -->

    <!-- Cart Floating Button -->
    <div class="ec-cart-float">
        <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
            <div class="header-icon"><img src="{{asset('public/frontend/assets/images/icons/cart.svg')}}" class="svg_img header_svg" alt="" /></div>
            <span class="ec-cart-count cart-count-lable">3</span>
        </a>
    </div>

<!-- Cart Floating Button end --> --}}
<script src="{{ asset('public/frontend/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/countdownTimer.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/slick.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>


@if (Route::currentRouteName() == 'search')
    <script src="{{ asset('public/frontend/assets/js/main.js') }}"></script>
@endif

<script src="{{ asset('public/frontend/assets/js/demo-3.js') }}"></script>


<script src="{{ asset('/public/js/jquery.validate.min.js') }}"></script>
<script>
    $(function() {
        $('#valid_form').validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.ec-register-wrap').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        @if (empty(Auth::guard('customer')->user()->id) &&
                request()->route()->getName() == 'index')
            $('#login_modal').modal('show');
        @endif
    });

    function open_product_model(product_id) {
        $.get("{{ route('modal.product.detail', '') }}/" + product_id, function(data, status) {
            $('#ec_quickview_modal').modal('show');
            $('#modal_body').html(data);
            $(".qty-product-cover").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: !1,
                fade: !1,
                asNavFor: ".qty-nav-thumb"
            }), $(".qty-nav-thumb").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: ".qty-product-cover",
                focusOnSelect: !0,
            })
            getVariantPrice();
        });
    }

    jQuery.fn.ForceNumericOnly =
        function() {
            return this.each(function() {
                $(this).keydown(function(e) {
                    var key = e.charCode || e.keyCode || 0;
                    // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                    // home, end, period, and numpad decimal
                    return (
                        key == 8 ||
                        key == 9 ||
                        key == 13 ||
                        key == 46 ||
                        key == 110 ||
                        key == 190 ||
                        (key >= 35 && key <= 40) ||
                        (key >= 48 && key <= 57) ||
                        (key >= 96 && key <= 105));
                });
            });
        };

    $(".number_only").ForceNumericOnly();
</script>

<script>
    function update_qty(type, product_id, range_qty, is_change) {
        var qty_id = '.qty_value_' + product_id;
        var qty_value = $(qty_id).val();
        if (type == 'plus') {
            var new_qty = parseInt(qty_value) + 1;
            if (range_qty) {
                if (new_qty <= range_qty) {
                    $('.qty_value_' + product_id).val(new_qty);
                    getVariantPrice();
                    @if (Auth::guard('customer')->check())
                        change_qty(product_id, new_qty)
                    @endif
                } else {
                    alert('Maximum Quantity Reached');
                }
            } else {
                $('.qty_value_' + product_id).val(new_qty);
                getVariantPrice();
                @if (Auth::guard('customer')->check())
                    change_qty(product_id, new_qty)
                @endif
            }
        } else {
            var new_qty = parseInt(qty_value) - 1;
            if (new_qty >= range_qty) {
                $('.qty_value_' + product_id).val(new_qty);
                getVariantPrice();
                @if (Auth::guard('customer')->check())
                    change_qty(product_id, new_qty)
                @endif
            } else {
                alert('Minimum Quantity Reached');
            }
        }
    }

    function change_qty(product_id, qty) {
        $.get("{{ route('change.cart.qty', ['', '']) }}/" + product_id + "/" + qty, function(data, status) {
            $("#addtocart_toast").addClass("show");
            $('#ec-side-cart').html(data.cart_detail)
            $('#cart-summary-div').html(data.cart_summary)
        });
    }

    function addtocart(product_ids, type) {
        if (type == 'flash_form') {
            form_id = '#flash_form_' + product_ids
        }
        if (type == 'new_arrival_form') {
            form_id = '#new_arrival_form_' + product_ids
        }
        if (type == 'feature_form') {
            form_id = '#feature_form_' + product_ids
        }
        if (type == 'best_seller_form') {
            form_id = '#best_seller_form_' + product_ids
        }
        if (type == 'product_model_form') {
            form_id = '#product_model_form'
        }
        if (type == 'product_detail_form') {
            form_id = '#product_detail_form'
        }
        if (type == 'featured_category_form') {
            form_id = '#featured_category_form_' + product_ids
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        var formData = new FormData($(form_id)[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('add.to.cart') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#ec-side-cart').html(data.html)
                $("#addtocart_toast").addClass("show");
                $('.header_cart_count').text(data.cart_count)
            },
            error: function(error) {
                @if (featureActivation('retailer') == '1' ||
                        featureActivation('distributor') == '1' ||
                        featureActivation('wholesaler') == '1')
                    window.location.href = "{{ route('user.login') }}";
                @endif
            }
        });
    }

    function buyNow(product_ids, type) {
        if (type == 'flash_form') {
            form_id = '#flash_form_' + product_ids
        }
        if (type == 'new_arrival_form') {
            form_id = '#new_arrival_form_' + product_ids
        }
        if (type == 'feature_form') {
            form_id = '#feature_form_' + product_ids
        }
        if (type == 'best_seller_form') {
            form_id = '#best_seller_form_' + product_ids
        }
        if (type == 'product_model_form') {
            form_id = '#product_model_form'
        }
        if (type == 'product_detail_form') {
            form_id = '#product_detail_form'
        }
        if (type == 'featured_category_form') {
            form_id = '#featured_category_form_' + product_ids
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        var formData = new FormData($(form_id)[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('add.to.cart') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#ec-side-cart').html(data.html)
                $("#addtocart_toast").addClass("show");
                $('.header_cart_count').text(data.cart_count);
                window.location.href = "{{ route('checkout') }}";
            },
            error: function(error) {
                @if (featureActivation('retailer') == '1' ||
                        featureActivation('distributor') == '1' ||
                        featureActivation('wholesaler') == '1')
                    window.location.href = "{{ route('user.login') }}";
                @endif
            }
        });
    }

    function addToWishlist(product_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('add.to.wishlist') }}",
            data: {
                product_id: product_id
            },
            success: function(data) {
                $("#addtocart_toast").addClass("show");
                $("#addtocart_toast").text("Product Added to Wishlist Successfully!");
            },
            error: function(error) {
                @if (featureActivation('retailer') == '1' ||
                        featureActivation('distributor') == '1' ||
                        featureActivation('wholesaler') == '1')
                    window.location.href = "{{ route('user.login') }}";
                @endif
            }
        });
    }

    function deleteToWishlist(product_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('delete.to.wishlist') }}",
            data: {
                product_id: product_id
            },
            success: function(data) {
                location.reload();
            }
        });
    }

    $('#product_detail_form input').on('change', function() {
        // getVariantPrice();
    });

    function selectVaraint(value, id) {
        $.ajax({
            type: "GET",
            url: '{{ route('product.get_selected_variant') }}',
            data: {
                color: value,
                product_group_id: id
            },
            success: function(data) {
                console.log(data);
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

    function selectVaraintAttribute(element, attr, id) {
        console.log(element.value, id);
        $.ajax({
            type: "GET",
            url: '{{ route('product.get_selected_variant') }}',
            data: {
                color: element.value,
                product_group_id: id,
                attr: attr
            },
            success: function(data) {
                $('#product_variant_div').empty();
                $('#product_variant_div').html(data);

            }
        });
    }
    @if (!empty(Auth::guard('customer')->user()))
      @if(Auth::guard('customer')->user()->verify_status == 1)
        function copy_text() {
            var text = '{{ Auth::guard('customer')->user()->referral_code }}';
            navigator.clipboard.writeText(text).then(function() {
                console.log('Async: Copying to clipboard was successful!');
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }
        @endif
    @endif
</script>
