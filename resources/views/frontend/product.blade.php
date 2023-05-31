<div class="col-lg-3 col-xs-6 col-md-6 col-sm-6 ec-product-content">
    <div class="ec-product-inner">
        <div class="ec-pro-image-outer">
            <div class="ec-pro-image">
                <a href="#" class="image">
                    @php
                        $gallery_images=explode(',',$productData->gallery_image);
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
                @if($productprice['discount'])
                    <span class="flags">
                        <span class="percentage">@if($productprice['discount_type'] == 'amount') ₹{{$productprice['discount']}} @else {{$productprice['discount']}}% @endif OFF</span>
                    </span>
                @endif

                    <div class="ec-pro-actions">
                        @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                            <form id="new_arrival_form_{{$productData->id}}">
                                <input type="hidden" name="product_id" value="{{$productData->id}}">
                                <button type="button" title="Add To Cart" class="bg-transparent" onclick="addtocart({{$productData->id}},'new_arrival_form')"><img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}" class="svg_img pro_svg" alt="" /></button>
                            </form>
                        @endif
                        <a href="#" class="ec-btn-group quickview" onclick="open_product_model({{$productData->id}})"><img src="{{ asset('public/frontend/assets/images/icons/quickview.svg') }}" class="svg_img pro_svg" alt="" /></a>
                        @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                          <a class="ec-btn-group" title="Wishlist" onclick="addToWishlist({{$productData->id}})"><img src="{{ asset('public/frontend/assets/images/icons/pro_wishlist.svg') }}" class="svg_img pro_svg" alt="" /></a>
                        @endif
                    </div>


            </div>
        </div>
        <div class="ec-pro-content">
            <h5 class="ec-pro-title"><a href="{{ route('search',$productData->slug) }}?type=product">{{$productData->name}}</a></h5>
            <span class="ec-price">
                @if($productprice['selling_price'] != $productprice['product_price'])
                    <span class="old-price">{{$productprice['selling_price']}}</span>
                    <span class="new-price">{{$productprice['product_price']}}</span>
                @else
                    <span class="new-price">{{$productprice['product_price']}}</span>
                @endif
            </span>
        </div>
    </div>
</div>
