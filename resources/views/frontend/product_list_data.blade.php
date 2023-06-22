<div class="shop-pro-inner">
    <div class="row">
        @foreach ($list as $data)
        @php
            $new_price=homePrice($data->id);
        @endphp
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 mb-6 pro-gl-content">
                <div class="ec-product-inner">
                    <div class="ec-pro-image-outer">
                        <div class="ec-pro-image">
                            <a href="{{ route('search',$data->slug) }}?type=product" class="image">
                                @php
                                    $gallery_images=explode(',',$data->gallery_image);
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
                            @php
                                $product_id=$data->id;
                                $in_offer=App\Models\Admin\Offer::where('is_active',1)->whereHas('offer_product', function($q) use ($product_id){
                                    $q->where('product_id',$product_id);
                                })->first();
                            @endphp
                            @if ($in_offer)
                                <span class="percentage">Big Deal</span>
                            @endif
                            @if($new_price['discount'])
                                <span class="flags">
                                    <span class="percentage">@if($new_price['discount_type'] == 'amount') ₹{{$new_price['discount']}} @else {{$new_price['discount']}}% @endif OFF</span>
                                </span>
                            @endif
                            <div class="ec-pro-actions">
                                @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                                 <button title="Add To Cart" class="add-to-cart">
                                    <img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}" class="svg_img pro_svg" alt="" />
                                    Add To Cart
                                 </button>
                                @endif
                                <a class="ec-btn-group quickview" title="quickview" onclick="open_product_model({{$data->id}})">
                                    <img src="{{ asset('public/frontend/assets/images/icons/quickview.svg') }}" class="svg_img pro_svg" alt="" />
                                </a>
                                @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                                <a class="ec-btn-group wishlist" title="Wishlist">
                                    <img src="{{ asset('public/frontend/assets/images/icons/wishlist.svg') }}" class="svg_img pro_svg" alt="" />
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="ec-pro-content">
                        <h5 class="ec-pro-title"><a href="{{ route('search',$data->slug) }}?type=product">@if($data->variant_name){{$data->variant_name}}@else{{$data->name}}@endif</a></h5>
                        <span class="ec-price">
                            @if($new_price['selling_price'] != $new_price['product_price'])
                                <span class="old-price">{{$new_price['selling_price']}}</span>
                                <span class="new-price">{{$new_price['product_price']}}</span>
                            @else
                                <span class="new-price">{{$new_price['product_price']}}</span>
                            @endif
                        </span>
                        @if($data->colors)
                            {{--<div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li><input type="color" data-tooltip="{{App\Models\Admin\Color::where('code',$data->colors)->first()->name}}" name="color" value="{{$data->color}}"></li>
                                    </ul>
                                </div>
                            </div>--}}
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="ec-pro-pagination">
    {{-- <span>Showing 1-12 of {{$list->total()}} item(s)</span> --}}
    <p><b>Showing {{($list->currentpage()-1)*$list->perpage()+1}} to {{(($list->currentpage()-1)*$list->perpage())+$list->count()}} of {{$list->total()}} Items</b></p>
    {{-- {!! $list->links() !!} --}}
    @include('backend.pagination',['list' =>$list,'class'=>'product_index'])
</div>
