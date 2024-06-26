<div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
    <div class="ec-sidebar-wrap">
        <style>

             .eci-whatsapp:before {
    content: "\f232";
    color: rgb(235, 249, 235);
}
.theme_btns {
    overflow: hidden;
    color: white !important;
    background: #28a745;
    font-size: 14px;
    font-weight: 600;
    line-height: 1;
    padding: 11px 15px 11px 15px;
    display: inline-block;
    border-radius: 4px;
    position: relative;
    z-index: 1;
    cursor: pointer;
    text-transform: uppercase;
    transition: all 0.4s ease-in-out;
    letter-spacing: 1px;
}

@media all and (min-width: 480px) {
    .desktop {display:block;}
    .mobile {display:none;}
}

@media all and (max-width: 479px) {
    .desktop {display:none;}
    .mobile {display:block;}
}
        </style>
        <!-- Sidebar Category Block -->
        <div class="ec-sidebar-block">
            <div class="ec-vendor-block">

                <div class="ec-vendor-block-detail">
                    <img src="@if(Auth::guard('customer')->user()->photo) {{asset('public/public/frontend/user_profile/'.Auth::guard('customer')->user()->photo)}} @else {{asset('public/public/frontend/assets/images/149071.png')}} @endif" alt="vendor image">
                    <h5 class="pt-3">{{Auth::guard('customer')->user()->first_name}} {{Auth::guard('customer')->user()->last_name}}</h5>
                    @if(Auth::guard('customer')->user()->type!='frenchies')

                    @if(featureActivation('mlm') == '1' && !empty(Auth::guard('customer')->user()->refered_by))
                      @if(Auth::guard('customer')->user()->verify_status==1)
                       <a  href="https://web.whatsapp.com/send?text=https://themeramart.com/user-register-mlm?referral_code={{Auth::guard('customer')->user()->referral_code}}" data-action="share/whatsapp/share" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="theme_btns theme_btn_bg desktop">
                        <i class="ecicon eci-whatsapp"></i> Share Referral Link</a>
                        @php $text=urlencode('https://themeramart.com/user-register-mlm?referral_code='.Auth::guard('customer')->user()->referral_code) @endphp
                        <a href="whatsapp://send?text={{$text}}" data-action="share/whatsapp/share" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="theme_btns theme_btn_bg mobile">
                            <i class="ecicon eci-whatsapp"></i> Share Referral Link</a>
                            <br>
                            <button onclick="copy_text()" >Click to copy  &nbsp;<i class="ecicon eci-copy"></i> </button>
                      @else <span class="out-of-stock" >{{'InActive'}} @endif</span>
                    @endif
                    @php

                    $order_data=App\Models\Order::where('user_id', Auth::guard('customer')->user()->id)->where('payment_status','success')->get();
                    $total_pv=0;
                    foreach($order_data as $data){
                        foreach($data->order_details as $order_detail){
                             $total_pv= $total_pv + ($order_detail->pv * $order_detail->quantity);
                         }
                    }
                    @endphp

                   Total PV: {{$total_pv}}
                   <div class="marquee">
                    @if(Auth::guard('customer')->user()->verify_status==0)
                      <p><b><marquee><a href="/">To Activate Your Account & Referral Code Please Buy a Product of Worth ₹999</a></marquee></b></p>
                    @endif

                    @if($total_pv < 40)
                     <p><b><marquee><a href="/">For getting team income 40 PV required.</a></marquee></b></p>
                    @endif
                  </div>
                  @endif
                </div>


                <div class="ec-vendor-block-items">
                    <ul>
                        {{-- <li><a href="{{route('user_dashboard')}}">Dashboard</a></li> --}}
                        <li><a href="{{route('user_profile')}}">User Profile</a></li>
                        <li><a href="{{route('user_wallet')}}">User Wallet</a></li>
                        @if(Auth::guard('customer')->user()->type!='frenchies')
                        <li><a href="{{route('manage.address')}}">Manage Address</a></li>
                        <li><a href="{{route('user_history')}}">Order History</a></li>
                        <li><a href="{{route('wishlist')}}">Wishlist</a></li>
                        <li><a href="{{route('cart')}}">Cart</a></li>
                        <li><a href="{{route('track_order')}}">Track Order</a></li>

                        <li><a href="{{route('payout.amount')}}">Received & Pending Amount</a></li>
                        <li><a href="{{route('user_commission')}}">Level Income History</a></li>
                        <li><a href="{{route('level.income.index')}}">Level Team</a></li>
                        <li><a href="{{route('repurchse.commission.list')}}">Repurchase Wallet</a></li>
                        @if(Auth::guard('customer')->user()->verify_status==1)
                        <li><a href="{{route('tree_view')}}">Tree</a></li>
                        @endif
                        <li><a href="{{route('user_referral')}}">Directs</a></li>
                        <li><a href="{{route('user_direct_commission')}}">Direct Pair Income</a></li>
                        <li><a href="{{route('user_ten_direct_commission')}}">Bonanza Income</a></li>
                        <li><a href="{{route('user_reward')}}">Reward Income</a></li>
                        <li><a href="{{route('user_under_forty_pv')}}">Under 40 PV</a></li>
                        @else
                        <li><a href="{{route('order_histroy')}}">Order History</a></li>
                        @endif

                        {{-- <li><a href="{{route('user_ten_direct_commission')}}">Franchise Income</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
