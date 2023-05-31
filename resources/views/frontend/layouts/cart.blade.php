@php
    $check_user=Auth::guard('customer')->check();
    if($check_user)
    {
        $user_id=Auth::guard('customer')->user()->id;
    }
    else
    {
        $check_session=Session::get('guest_id');
        if($check_session)
        {
            $user_id=$check_session;
        }
        else
        {
            $user_id='';
        }
    }
    $cart_items=App\Models\Cart::where('user_id',$user_id)->get();
    $cart_total_amount=0;
    foreach($cart_items as $cart_item)
    {
        $cart_total_amount=$cart_total_amount+$cart_item->product->price*$cart_item->quantity;
    }
@endphp

<aside class="slide-bars">
    <a onclick="closes()">
    <div class="close-mobile-menus">
       <i class="fas fa-times"></i>
    </div></a>

    <div class="offset-sidebar">
        <div class="offset-widget mb-40">
            <div class="cartt">
                <div class="heding">
                    <h4>Donation summary</h4>
                </div>
                <h3 class="sub-heading-suggestion">Cart items</h3>
                @forelse($cart_items as $cart_item)
                    <div class="packet-card-wrapper">
                        <div class="packet-card-container">
                            <div class="packet-card">
                                <h3 class="packet-card-heading">{{$cart_item->campaign->name}}</h3>
                                <h5 class="packet-name">{{$cart_item->product->name}}</h5>
                                <h6 class="packet-amount">₹{{$cart_item->product->price}} / {{$cart_item->product->unit}}</h6>
                            </div>
                        </div>
                        <div class="button-text-field-container">
                            <div class="row no-gutters align-items-center aiz-plus-minus" style="width: 140px;">
                                <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" onclick="add_to_cart({{$cart_item->product_id}},'-','cart',{{$cart_item->product->minimum_quantity}})">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>
                                <input type="text" name="quantity" class="text-center input-number quantity_input{{$cart_item->product->id}}" value="{{$cart_item->quantity}}" readonly>
                                <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light mr-1" type="button" onclick="add_to_cart({{$cart_item->product_id}},'+','cart',{{$cart_item->product->minimum_quantity}})">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" type="button" onclick="add_to_cart({{$cart_item->product_id}},0,'cart',{{$cart_item->product->minimum_quantity}})" style="height: 31px">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                <center style="padding: 25px;"><i class="far fa-frown" style="font-size: 40px;"></i><br><br><h3>Nothing Found</h3></center>
                @endforelse
            </div>
            <div class="abs">
            <div class="total-donation-container mt-10">
                <div>Total Donation</div>
                <div>₹ {{$cart_total_amount}}</div>
            </div>
            <div class="input-btn mt-10">
                <a @if($cart_total_amount == 0) href="{{route('campaign')}}" @else href="{{route('checkout')}}" @endif><button class="theme_btn theme_btn_bg large_btn" style="padding: 18px;">Donate Now</button></a>
            </div>
        </div>
        </div>
    </div>
</aside>

<aside class="slide-bar">
    <div class="close-mobile-menu">
        <a href="javascript:void(0);"><i class="fas fa-times"></i></a>
    </div>
    <nav class="side-mobile-menu">
        <ul id="mobile-menu-active">
            <li><a href="{{ route('campaign') }}">Explore Campaigns</a></li>
            <li><a href="{{route('monthly_donate')}}">Donate Monthly</a></li>
            <li><a href="{{ route('request_campaign') }}">Request A Campaign</a></li>
            <li><a href="{{ route('how.it.work') }}">How It Works</a></li>
            <li><a href="{{ route('blog') }}">Blogs</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li>
            @if(Auth::guard('customer')->check())
            <a href="{{route('customer.logout')}}">Logout</a>
            @else
            <a href="{{route('user.login')}}"><i class="fa fa-lock"></i> Join Us / Login</a>
            @endif
          </li>
        </ul>
    </nav>
</aside>
