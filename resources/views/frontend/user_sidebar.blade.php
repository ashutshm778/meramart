<div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
    <div class="ec-sidebar-wrap">
        <!-- Sidebar Category Block -->
        <div class="ec-sidebar-block">
            <div class="ec-vendor-block">
                <div class="ec-vendor-block-bg"></div>
                <div class="ec-vendor-block-detail">
                    <img class="v-img" src="@if(Auth::guard('customer')->user()->photo) {{asset('public/public/frontend/user_profile/'.Auth::guard('customer')->user()->photo)}} @else {{asset('public/public/frontend/assets/images/149071.png')}} @endif" alt="vendor image">
                    <h5>{{Auth::guard('customer')->user()->first_name}} {{Auth::guard('customer')->user()->last_name}}</h5>
                </div>
                <div class="ec-vendor-block-items">
                    <ul>
                        {{-- <li><a href="{{route('user_dashboard')}}">Dashboard</a></li> --}}
                        <li><a href="{{route('user_profile')}}">User Profile</a></li>
                        <li><a href="{{route('manage.address')}}">Manage Address</a></li>
                        <li><a href="{{route('user_history')}}">Order History</a></li>
                        <li><a href="{{route('wishlist')}}">Wishlist</a></li>
                        <li><a href="{{route('cart')}}">Cart</a></li>
                        <li><a href="{{route('track_order')}}">Track Order</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
