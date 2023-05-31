@extends('frontend.layouts.app')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Cart</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Cart</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec cart page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <form action="#">
                                    <div class="table-content cart-table-content">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th style="text-align: center;">Quantity</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $sub_total_amount = 0;
                                                    $total_discount = 0;
                                                    $total_amount = 0;
                                                @endphp
                                                @foreach (App\Models\Cart::where('user_id',Auth::guard('customer')->user()->id)->get() as $cart)
                                                @php
                                                    $product_prices = homePrice($cart->product_id);
                                                    $sub_total_amount = $sub_total_amount + $product_prices['s_p'] * $cart->quantity;
                                                    $total_discount = ($total_discount + $product_prices['s_p'] - $product_prices['p_p']) * $cart->quantity;
                                                    $total_amount = $total_amount + $product_prices['p_p'] * $cart->quantity;
                                                @endphp
                                                    <tr>
                                                        <td data-label="Product" class="ec-cart-pro-name">
                                                            <a href="product-left-sidebar.html"><img class="ec-cart-pro-img mr-4" src="{{asset('public/'.api_asset($cart->product->thumbnail_image))}}" alt="" />{{$cart->product->name}}</a>
                                                        </td>
                                                        <td data-label="Price" class="ec-cart-pro-price">
                                                            <span class="amount">₹{{$cart->product->retailer_selling_price}}</span>
                                                        </td>
                                                        <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                                                            <div class="row">
                                                                <button type="button" class="btn btn-danger btn-number" onclick="update_qty('minus',{{$cart->product_id}},{{ $product_prices['min_qty'] > 0 ? $product_prices['min_qty'] :'null' }},'ajax')" style="width: auto;">
                                                                    <span class="ecicon eci-minus"></span>
                                                                </button>
                                                                <input type="number" id="quantity" name="product_qty" class="form-control text-center qty_value_{{$cart->product_id}}" value="{{$cart->quantity}}" min="{{$cart->product->retailer_min_qty}}" max="{{$cart->product->retailer_max_qty}}" style="width:60px; padding: 0 10px; height: auto;">
                                                                <button type="button" class="btn btn-danger btn-number btn-number"  onclick="update_qty('plus',{{$cart->product_id}},{{ $product_prices['max_qty'] > 0 ? $product_prices['max_qty'] :'null' }},'ajax')" style="width: auto;">
                                                                    <span class="ecicon eci-plus"></span>
                                                                </button>
                                                             </div>
                                                        </td>
                                                        <td data-label="Total" class="ec-cart-pro-subtotal">₹{{$cart->product->retailer_selling_price * $cart->quantity}}</td>
                                                        <td data-label="Remove" class="ec-cart-pro-remove">
                                                            <a href="{{route('delete.to.cart',$cart->id)}}"><i class="ecicon eci-trash-o"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ec-cart-update-bottom">
                                                <a href="{{route('index')}}">Continue Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Summary</h3>

                            </div>

                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div id="cart-summary-div">
                                        @include('frontend.cart_summary')
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ec-cart-update-bottom">
                                                <a class="btn btn-primary text-white" href="{{route('checkout')}}">Proceed to Check Out</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection
