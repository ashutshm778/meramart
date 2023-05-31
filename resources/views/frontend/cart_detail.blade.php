<div class="ec-cart-inner">
    <div class="ec-cart-top">
        <div class="ec-cart-title">
            <span class="cart_title">My Cart</span>
            <button class="ec-close">×</button>
        </div>
        <ul class="eccart-pro-items">
            @if(Auth::guard('customer')->check())
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
                    <li class="">
                        <a href="#" class="sidecart_pro_img">
                            <img src="{{asset('public/'.api_asset($cart->product->thumbnail_image))}}"
                                alt="product">
                        </a>
                        <div class="ec-pro-content">
                            <a href="{{ route('search',$cart->product->slug) }}?type=product" class="cart_pro_title">{{$cart->product->name}}</a>
                            <span class="cart-price">@if ($product_prices['selling_price'] != $product_prices['product_price'])
                                <span class="new-price"><del
                                        class="discount">{{ $product_prices['selling_price'] }}</del>
                                    {{ $product_prices['product_price'] }}</span>
                            @else
                                <span class="new-price"> {{ $product_prices['product_price'] }}</span>
                            @endif x {{$cart->quantity}}</span>
                            {{-- <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="{{$cart->quantity}}" id="cart_quantity_input_{{$cart->id}}" onclick="change_quantity({{$cart->id}})">
                            </div> --}}
                            <div class="row">
                                <button type="button" class="btn btn-danger btn-number" onclick="update_qty('minus',{{$cart->product_id}},{{ $product_prices['min_qty'] > 0 ? $product_prices['min_qty'] :'null' }},'ajax')" style="width: auto;">
                                    <span class="ecicon eci-minus"></span>
                                </button>
                                <input type="number" id="quantity" name="product_qty" class="form-control text-center qty_value_{{$cart->product_id}}" value="{{$cart->quantity}}" min="{{$cart->product->retailer_min_qty}}" max="{{$cart->product->retailer_max_qty}}" style="width:60px; padding: 0 10px; height: auto;">
                                <button type="button" class="btn btn-danger btn-number btn-number"  onclick="update_qty('plus',{{$cart->product_id}},{{ $product_prices['max_qty'] > 0 ? $product_prices['max_qty'] :'null' }},'ajax')" style="width: auto;">
                                    <span class="ecicon eci-plus"></span>
                                </button>
                                </div>
                            <a href="#" style="line-height: 1.5;position: absolute;top: 0;right: 0;padding: 0 9px;color: red;font-size: 16px;" onclick="remove_to_cart({{$cart->id}})">×</a>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    @if(Auth::guard('customer')->check())
        <div class="ec-cart-bottom">
            <div class="cart-sub-total">
                <table class="table cart-table">
                    <tbody>
                        <tr>
                            <td class="text-left">Sub-Total :</td>
                            <td class="text-right">₹{{$sub_total_amount}}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Discount :</td>
                            <td class="text-right">₹{{$total_discount}}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Total :</td>
                            <td class="text-right primary-color">₹{{$total_amount}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart_btn">
                <a href="{{ route('cart') }}" class="btn btn-primary">View Cart</a>
                <a href="{{ route('checkout') }}" class="btn btn-secondary">Checkout</a>
            </div>
        </div>
    @endif
</div>

<script>
    var buttonPlus  = $(".qty-btn-plus");
    var buttonMinus = $(".qty-btn-minus");

    var incrementPlus = buttonPlus.click(function() {
        var $n = $(this)
        .parent(".qty-container")
        .find(".input-qty");
        $n.val(Number($n.val())+1);
        var product_id = $n.attr('id');
        var qty = $n.val();
        change_qty(product_id,qty)
    });

    var incrementMinus = buttonMinus.click(function() {
        var $n = $(this)
        .parent(".qty-container")
        .find(".input-qty");
        var amount = Number($n.val());
        if (amount > 1)
        {
            $n.val(amount-1);
            var product_id = $n.attr('id');
            var qty = $n.val();
            change_qty(product_id,qty)
        }
    });
</script>
