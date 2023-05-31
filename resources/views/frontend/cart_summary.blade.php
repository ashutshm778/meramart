@php
    $sub_total_amount = 0;
    $total_discount = 0;
    $total_amount = 0;
@endphp
@foreach (App\Models\Cart::where('user_id',Auth::guard('customer')->user()->id)->get() as $cart)
    @php
        $product_prices = getProductDiscountedPrice($cart->product_id,'retailer');
        $sub_total_amount = $sub_total_amount + $product_prices['selling_price'] * $cart->quantity;
        $total_discount = ($total_discount + $product_prices['selling_price'] - $product_prices['product_price']) * $cart->quantity;
        $total_amount = $total_amount + $product_prices['product_price'] * $cart->quantity;
    @endphp
@endforeach
<div class="ec-cart-summary">
    <div>
        <span class="text-left">Sub-Total</span>
        <span class="text-right">₹{{$sub_total_amount}}</span>
    </div>
    <div>
        <span class="text-left">Discount Charges</span>
        <span class="text-right">₹{{$total_discount}}</span>
    </div>

    <div class="shipping">
        <span class="text-left">Shipping</span>
        <span class="text-right">Shipping to Uttar Pradesh</span>
    </div>

    <div class="ec-cart-summary-total">
        <span class="text-left">Total Amount</span>
        <span class="text-right">₹{{$total_amount}}</span>
    </div>
</div>
