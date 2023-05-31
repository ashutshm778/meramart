@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Checkout</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="ec-page-content checkout_page section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-checkout-leftside col-lg-8 col-md-12 ">
                    <div class="ec-checkout-content">
                        <div class="ec-checkout-inner">
                            <div class="ec-checkout-wrap margin-bottom-30">
                                <div class="ec-checkout-block ec-check-bill">
                                    <h3 class="ec-checkout-title">Billing Details</h3>
                                    @if(session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item ec-faq-block">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Address
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="ec-bl-block-content">
                                                        <span class="ec-bill-option">
                                                            @foreach (App\Models\CustomerAddress::where('user_id',Auth::guard('customer')->user()->id)->get() as $add_key=>$customer_address)
                                                                <div class="address">
                                                                    <input type="radio" id="address_select_{{$add_key+1}}" value="{{$customer_address->id}}" name="address_select" checked>
                                                                    <label for="address_select_{{$add_key+1}}"><b>{{$customer_address->name}}</b></label>
                                                                    <p>{{$customer_address->address}} {{App\Models\Admin\City::where('id',$customer_address->city)->first()->city}} {{App\Models\Admin\State::where('id',$customer_address->state)->first()->state}} {{$customer_address->country}} {{$customer_address->pincode}}</p>
                                                                </div>
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item ec-faq-block">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <i class="ecicon eci-plus"></i> &nbsp; Add New Address
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                    <div class="ec-bl-block-content">
                                                        <div class="ec-check-bill-form">
                                                            <form action="{{route('store.customer.address')}}" method="post">
                                                                @csrf
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>Your Name*</label>
                                                                    <input type="text" name="name" id="name" placeholder="Enter your Name" required>
                                                                </span>
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>Your Phone Number*</label>
                                                                    <input type="text" name="phone" id="phone" placeholder="Enter your Phone Number" required>
                                                                </span>
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>Zip code *</label>
                                                                    <input type="text" name="pincode" id="pincode" placeholder="Post Code" onchange="get_address()" required>
                                                                </span>
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>City *</label>
                                                                    <input type="text" name="city" id="city" placeholder="Enter your City" readonly required>
                                                                </span>
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>State *</label>
                                                                    <input type="text" name="state" id="state" placeholder="Enter your State" readonly required>
                                                                </span>
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>Country *</label>
                                                                    <input type="text" name="country" id="country" placeholder="Enter your Country" readonly required>
                                                                </span>
                                                                <span class="ec-bill-wrap">
                                                                    <label>Address</label>
                                                                    <textarea placeholder="Address" name="address" id="address" required></textarea>
                                                                </span>
                                                                <span class="ec-bill-wrap mt-2">
                                                                    <button class="btn btn-primary">Save And Deliver Here</button>
                                                                </span>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item ec-faq-block">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree"> Order Summary </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="ec-bl-block-content">
                                                        <div class="col-sm-12">
                                                            @foreach (App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)->get() as $cart)
                                                                @php
                                                                    $product_prices = getProductDiscountedPrice($cart->product_id, 'retailer');
                                                                @endphp
                                                                <div class="order-sumary pt-2">
                                                                    <div class="pro-img">
                                                                        <a href="#">
                                                                            <img class="main-image" src="{{ asset('public/' . api_asset($cart->product->thumbnail_image)) }}" class="w-100" alt="Product" />
                                                                        </a>
                                                                    </div>
                                                                    <div class="pro-content">
                                                                        <h5><a href="#">{{ $cart->product->name }}</a></h5>
                                                                        <span class="ec-price">
                                                                            @if ($product_prices['selling_price'] > $product_prices['product_price'])
                                                                            <span class="old-price">₹{{ $product_prices['selling_price'] }}</span>
                                                                            <span class="new-price">₹{{ $product_prices['product_price'] }}</span>
                                                                            * {{ $cart->quantity }}
                                                                        @else
                                                                            <span class="new-price">₹{{ $product_prices['product_price'] }}</span>
                                                                            * {{ $cart->quantity }}
                                                                        @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item ec-faq-block">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">Payment Option </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="aiz-megabox d-block mb-3">
                                                                <a onclick="make_order('razorpay')">
                                                                <span class="d-block p-2 aiz-megabox-elem">
                                                                    <img src="{{asset('public/frontend/assets/images/rozarpay.png')}}" class="img-fluid mb-2">
                                                                    <span class="d-block text-center">
                                                                        <h4 class="ec-sidebar-title">Pay Online</h4>
                                                                    </span>
                                                                </span>
                                                                </a>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="aiz-megabox d-block mb-3">
                                                                <a onclick="make_order('cod')">
                                                                    <span class="d-block p-2 aiz-megabox-elem">
                                                                        <img src="{{asset('public/frontend/assets/images/cod.png')}}" class="img-fluid mb-2">
                                                                        <span class="d-block text-center">
                                                                            <h4 class="ec-sidebar-title">Cash on Delivery</h4>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="ec-bl-block-content">
                                                        <span class="ec-bill-option">
                                                            <div class="address">
                                                                <input type="radio" id="info" name="radio-group">
                                                                <label for="info">
                                                                    <img src="{{ asset('public/frontend/assets/images/icons/payment1.png') }}" style="width: 35px;"> &nbsp; <b>Credit Card
                                                                    <small>XXXX XXXX XXXX 1234</small></b>
                                                                </label>
                                                            </div>
                                                            <div class="address">
                                                                <input type="radio" id="upid" name="radio-group">
                                                                <label for="upid">
                                                                    <img src="{{ asset('public/frontend/assets/images/icons/upi.png') }}" style="width: 35px;"> &nbsp;<b>UPI ID
                                                                    <small>1123456789@ybl</small></b>
                                                                </label>
                                                            </div>
                                                            <div class="address">
                                                                <input type="radio" id="phonepay" name="radio-group">
                                                                <label for="phonepay">
                                                                    <img src="{{ asset('public/frontend/assets/images/icons/phonepe.png') }}" style="width: 35px;"> &nbsp;<b>Phonepay
                                                                    UPI<small>1123456789@ybl</small></b>
                                                                </label>
                                                            </div>
                                                            <div class="address">
                                                                <input type="radio" id="upi" name="radio-group">
                                                                <label for="upi">
                                                                    <img src="{{ asset('public/frontend/assets/images/icons/g-pay.png') }}" style="width: 35px;"> &nbsp;<b>UPI</b>
                                                                </label>
                                                            </div>
                                                            <div class="address">
                                                                <input type="radio" id="wallet" name="radio-group">
                                                                <label for="wallet">
                                                                    <img src="{{ asset('public/frontend/assets/images/icons/phonepe.png') }}" style="width: 35px;"> &nbsp;<b>Wallet</b>
                                                                </label>
                                                            </div>
                                                            <div class="address">
                                                                <input type="radio" id="card" name="radio-group">
                                                                <label for="card"><b>Credi / Debit / ATM Card</b></label>
                                                                <p> Add and secure your card as per RBI guidelines.</p>
                                                            </div>
                                                        </span>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <span class="ec-check-order-btn">
                                <a class="btn btn-primary" href="#">Place Order</a>
                            </span> --}}
                        </div>
                    </div>
                </div>
                <div class="ec-checkout-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Summary</h3>
                            </div>
                            @php
                                $sub_total_amount = 0;
                                $total_discount = 0;
                                $total_amount = 0;
                            @endphp
                            @foreach (App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)->get() as $cart)
                                @php
                                    $product_prices = getProductDiscountedPrice($cart->product_id, 'retailer');
                                    $sub_total_amount = $sub_total_amount + $product_prices['selling_price'] * $cart->quantity;
                                    $total_discount = ($total_discount + $product_prices['selling_price'] - $product_prices['product_price']) * $cart->quantity;
                                    $total_amount = $total_amount + $product_prices['product_price'] * $cart->quantity;
                                @endphp
                            @endforeach
                            <div class="ec-sb-block-content">
                                <div class="ec-checkout-summary">
                                    <div>
                                        <span class="text-left">Sub-Total</span>
                                        <span class="text-right">₹{{ $sub_total_amount }}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Discount Charges</span>
                                        <span class="text-right">₹{{ $total_discount }}</span>
                                    </div>

                                    <div class="ec-checkout-summary-total">
                                        <span class="text-left">Total Amount</span>
                                        <span class="text-right">₹{{ $total_amount }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ec-sidebar-wrap ec-check-pay-img-wrap">
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Payment Method</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-check-pay-img-inner">
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment1.png') }}" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment2.png') }}" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment3.png') }}" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment4.png') }}" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment5.png') }}" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment6.png') }}" alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment7.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>

    function get_address()
    {
        var pincode = $('#pincode').val()
        $.get("{{route('get.address.by.pincode','')}}"+"/"+pincode, function(data)
        {
            if(data)
            {
                $('#city').val(data.city.city)
                $('#state').val(data.state.state)
                $('#country').val(data.country.country)
            }
            else
            {
                $('#city').val('')
                $('#state').val('')
                $('#country').val('')
                $('#id').val('')
                $('#name').val('')
                alert('You have Enter Wrong Pincode!')
            }
        }).fail(function()
        {
            alert('You have Enter Wrong Pincode!')
        });
    }

    function make_order(type)
    {
        var shipping_address_id = $('input[name="address_select"]:checked').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url:"{{route('customer.store.order')}}",
            data:{
                shipping_address_id:shipping_address_id,
                payment_type:type,
            },
            success: function(data){
                window.location.href = "{{route('order.summary')}}";
            }
        });
    }

</script>
