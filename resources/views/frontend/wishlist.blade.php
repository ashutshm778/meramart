 @extends('frontend.layouts.app')
 @section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Wishlist</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Wishlist</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-wish-rightside col-lg-12 col-md-12">
                    <div class="ec-compare-content">
                        <div class="ec-compare-inner">
                            <div class="row margin-minus-b-30">
                                @foreach (App\Models\Wishlist::where('user_id',Auth::user()->id)->with('product')->get() as $wishlist)
                                    @php
                                        $wishlist_price=getProductDiscountedPrice($wishlist->product->id,'retailer');
                                    @endphp
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="#" class="image">
                                                        @php
                                                            $gallery_images=explode(',',$wishlist->product->gallery_image);
                                                        @endphp
                                                        @foreach ($gallery_images as $new_key=>$gallery_image)
                                                            @if(count($gallery_images) >= 2)
                                                                @if($new_key == 0)
                                                                    <img class="main-image" src="{{asset('public/'.api_asset($gallery_image))}}" alt="Product" />
                                                                @else
                                                                    <img class="hover-image" src="{{asset('public/'.api_asset($gallery_image))}}" alt="Product" />
                                                                @endif
                                                            @else
                                                                <img class="main-image" src="{{asset('public/'.api_asset($gallery_image))}}" alt="Product" />
                                                            @endif
                                                        @endforeach
                                                    </a>
                                                    <span class="ec-com-remove ec-remove-wish"><a onclick="deleteToWishlist({{$wishlist->product->id}})">×</a></span>
                                                    @if($wishlist_price['discount'])
                                                        <span class="flags">
                                                            <span class="percentage">@if($wishlist_price['discount_type'] == 'amount') ₹{{$wishlist_price['discount']}} @else {{$wishlist_price['discount']}}% @endif OFF</span>
                                                        </span>
                                                    @endif
                                                    <a href="#" class="ec-btn-group quickview" onclick="open_product_model({{$wishlist->product->id}})"><img src="{{ asset('public/frontend/assets/images/icons/quickview.svg') }}" class="svg_img pro_svg" alt="" /></a>
                                                    <div class="ec-pro-actions">

                                                        <form id="new_arrival_form_{{$wishlist->product->id}}">
                                                            <input type="hidden" name="product_id" value="{{$wishlist->product->id}}">
                                                            <button type="button" title="Add To Cart" class="add-to-cart" onclick="addtocart({{$wishlist->product->id}},'new_arrival_form')">
                                                                <img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}" class="svg_img pro_svg" alt="" /> Add To Cart
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title"><a href="{{ route('search',$wishlist->product->slug) }}?type=product">{{$wishlist->product->name}}</a></h5>
                                                {{-- <div class="ec-pro-rating">
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star"></i>
                                                </div> --}}
                                                {{-- <div class="ec-pro-list-desc">
                                                    Lorem Ipsum is simply dummy text of the printing
                                                    and typesetting industry. Lorem Ipsum is simply dutmmy text ever since the
                                                    1500s, when an unknown printer took a galley.</div> --}}
                                                <span class="ec-price">
                                                    @if($wishlist_price['selling_price'] != $wishlist_price['product_price'])
                                                        <span class="old-price">₹{{$wishlist_price['selling_price']}}</span>
                                                        <span class="new-price">₹{{$wishlist_price['product_price']}}</span>
                                                    @else
                                                        <span class="new-price">₹{{$wishlist_price['product_price']}}</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 @endsection
