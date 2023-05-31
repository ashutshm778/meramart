@php
    $product_price = homePrice($data->id);
@endphp
<div class="row">
    <div class="col-md-5 col-sm-12 col-xs-12">
        @php
            $gallery_images = explode(',', $data->gallery_image);
        @endphp
        <div class="qty-product-cover">
            @foreach ($gallery_images as $new_key => $gallery_image)
                <div class="qty-slide">
                    <img class="img-responsive" src="{{ asset('public/' . api_asset($gallery_image)) }}" alt="">
                </div>
            @endforeach
        </div>
        <div class="qty-nav-thumb">
            @foreach ($gallery_images as $new_key => $gallery_image)
                <div class="qty-slide">
                    <img class="img-responsive" src="{{ asset('public/' . api_asset($gallery_image)) }}" alt="">
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-7 col-sm-12 col-xs-12">
        <div class="quickview-pro-content single-pro-content">
            <h5 class="ec-quick-title"><a href="#">{{ $data->name }}</a></h5>
            {{-- <div class="ec-quickview-rating">
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star"></i>
            </div> --}}
            <div class="ec-quickview-desc">{!! $data->description !!}</div>
            <div class="ec-single-price-stoke">
                <div class="ec-single-price">
                    @if ($product_price['selling_price'] != $product_price['product_price'])
                        <span class="new-price"><del class="discount">{{ $product_price['selling_price'] }}</del>
                            {{ $product_price['product_price'] }}</span>
                    @else
                        <span class="new-price"> {{ $product_price['product_price'] }}</span>
                    @endif
                </div>
                @if ($data->sku)
                    <div class="ec-single-stoke">
                        <span class="ec-single-sku">SKU#: {{ $data->sku }}</span>
                    </div>
                @endif
            </div>

            <div class="ec-single-qty">
                <form id="product_detail_form">
                    @csrf
                    <input type="hidden" name="type" value="model" />
                    <div class="ec-pro-variation">

                        @php
                            $var_pros = App\Models\Admin\Product::where('product_group_id', $data->product_group_id)->get();
                            $attributes = [];
                            foreach ($var_pros as $products) {
                                if (is_array($products->attribute)) {
                                    foreach ($products->attribute as $attribute) {
                                        array_push($attributes, $attribute);
                                    }
                                }
                            }
                            $unique_attributes = array_unique($attributes);

                            $attributes_value = [];
                            foreach ($unique_attributes as $attr) {
                                foreach ($var_pros as $prod) {
                                    if (is_array($prod->attribute)) {
                                        foreach ($prod->attribute as $key => $p_a) {
                                            if ($p_a == $attr) {
                                                array_push($attributes_value, [$attr => $prod->attribute_value[$key]]);
                                            }
                                        }
                                    }
                                }
                            }
                        @endphp
                        <div class="ec-pro-variation-inner ec-pro-variation-size">
                            @foreach ($unique_attributes as $attr)
                                <span>{{ App\Models\Admin\Attribute::find($attr)->name }}</span>
                                <div class="ec-pro-variation-content">
                                    @php $at_array=[]; @endphp
                                    @foreach ($attributes_value as $av)
                                        @if (!empty($av[$attr]))
                                            @php array_push($at_array,$av[$attr]); @endphp
                                        @endif
                                    @endforeach
                                    <ul>
                                        @foreach (array_unique($at_array) as $key => $dv)
                                            <li @foreach ($product_attribut_array as $array_a) @if (in_array($dv, $array_a))  @if (in_array($attr, $array_a)) class="active" @endif  @endif @endforeach>
                                                <input type="radio"name="attribute_id_{{ $attr }}"
                                                    id="attribute_id_{{ $attr }}_{{ $dv }}"
                                                    value="{{ $dv }}"
                                                    onclick="getVaiantPriceData('{{ $data->product_group_id }}','{{ $attr }}','{{ $dv }}')"
                                                    @foreach ($product_attribut_array as $array_a) @if (in_array($dv, $array_a))  @if (in_array($attr, $array_a)){{ 'checked' }} @endif  @endif @endforeach>
                                                <label for="attribute_id_{{ $attr }}_{{ $dv }}">
                                                    {{ $dv }} </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>


                        @php
                            $colors = App\Models\Admin\Product::where('product_group_id', $data->product_group_id)
                                ->where('colors', '!=', '')
                                ->get(['colors'])
                                ->unique('colors');
                        @endphp
                        @if (count($colors) > 0)
                            <div class="ec-pro-variation-inner ec-pro-variation-color">

                                <span>Color</span>
                                <div class="ec-pro-variation-content">
                                    <ul>
                                        @foreach ($colors as $key => $color)
                                            <li data-toggle="" data-title="{{ App\Models\Admin\Color::where('code', $color->colors)->first()->name }}">

                                                <label class="aiz-megabox" for="color_{{ $color->colors }}"
                                                    style="background: {{ $color->colors }};"
                                                    title="{{ App\Models\Admin\Color::where('code', $color->colors)->first()->name }}">
                                                    <input type="radio" name="color" id="color_{{ $color->colors }}"
                                                    value="{{ $color->colors }}"
                                                    onclick="getVaiantPriceColorData('{{ $data->product_group_id }}','{{ $color->colors }}')"
                                                    @if (!empty($data->colors)) @if ($data->colors == $color->colors) {{ 'checked' }} @endif
                                                    @endif >
                                                    <span class="aiz-megabox-elem">
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        @endif
                        <div class="row" id="chosen_price_div">
                            <div class="col-md-3">
                                <span>Total Price:</span>
                            </div>
                            <div class="col-md-9">
                                <div class="ec-single-price">
                                    <span class="new-price">
                                        @if (!empty($total_price))
                                            {{ '₹' . $total_price }}@endif
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>



                    @php
                        if (Auth::guard('customer')->check()) {
                            $pro_cart = App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)
                                ->where('product_id', $data->id)
                                ->first();
                            if ($pro_cart) {
                                $pro_qty = $pro_cart->quantity;
                            }
                        }
                    @endphp

                    <div class="ec-single-qty">
                        <button type="button" class="btn btn-danger btn-number"
                            onclick="update_qty('minus',{{ $data->id }},{{ $product_price['min_qty'] > 0 ? $product_price['min_qty'] : 'null' }},'form')">
                            <span class="ecicon eci-minus"></span>
                        </button>
                        <input type="number" id="quantity" name="product_qty"
                            class="form-control text-center qty_value_{{ $data->id }}"
                            value="@if(!empty($pro_qty)){{$pro_qty}}@else{{!empty($product_quanity)?$product_quanity:'1'}}@endif"
                            min="{{ $data->retailer_min_qty }}"
                            max="{{ $product_price['max_qty'] > 0 ? $product_price['max_qty'] : 'null' }}"
                            style="width:110px; padding: 0 10px; height:45px; border-radius: 0; border-width:1px 0 1px 0;">
                        <button type="button" class="btn btn-danger btn-number btn-number"
                            onclick="update_qty('plus',{{ $data->id }},{{ $product_price['max_qty'] > 0 ? $product_price['max_qty'] : 'null' }},'form')">
                            <span class="ecicon eci-plus"></span>
                        </button>
                        <input type="hidden" name="product_id" value="{{ $data->id }}">
                        <input type="hidden" name="product_group_id" value="{{ $data->product_group_id }}">
                        <div class="ec-single-cart ">
                            <button type="button" class="btn btn-primary" onclick="addtocart({{ $data->id }},'product_detail_form')">
                                    <i class="ecicon eci-shopping-cart"></i> &nbsp;Add To Cart
                            </button>
                        </div>
                        <div class="ec-single-cart ">
                            <button  type="button" class="btn btn-primary" onclick="buyNow({{ $data->id }},'product_detail_form')">
                                <i class="ecicon eci-shopping-cart"></i> &nbsp;Buy Now
                            </button>
                        </div>
                        <div class="ec-single-wishlist">
                            <a class="ec-btn-group wishlist" title="Wishlist">
                                <i class="ecicon eci-heart-o"></i>
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/frontend/assets/js/zoom-image.js') }}"></script>
<script type="text/javascript">
    if (window.innerWidth > 768) {
        $('.imgBox').imgZoom({
            boxWidth: 500,
            boxHeight: 500,
            marginLeft: 5,
            origin: 'data-origin'
        });
    }

    $(document).ready(function() {
        $('.show-small-img').click(function() {
            $('#show-img').attr('data-origin', $(this).attr('src'));
        });
    });

    function getVariantPrice() {
        $.ajax({
            type: "GET",
            url: '{{ route('product.get_varinat_price') }}',
            data: $('#product_detail_form').serializeArray(),
            success: function(data) {

                $('#modal_body').empty();
                $('#modal_body').html(data);
                $(".qty-product-cover").slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: !1,
                    fade: !1,
                    asNavFor: ".qty-nav-thumb"
                }), $(".qty-nav-thumb").slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: ".qty-product-cover",
                    focusOnSelect: !0,
                })
            }
        });
    }

    function getVaiantPriceData(product_group_id, attribute_id, attribute_value) {
        var quanity = $('#quantity').val();
        $.ajax({
            type: "GET",
            url: '{{ route('product.get_varinat_price_data') }}',
            data: {
                product_group_id: product_group_id,
                attribute_id: attribute_id,
                attribute_value: attribute_value,
                product_qty: quanity,
                type: 'model'
            },
            success: function(data) {

                $('#modal_body').empty();
                $('#modal_body').html(data);
                $(".qty-product-cover").slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: !1,
                    fade: !1,
                    asNavFor: ".qty-nav-thumb"
                }), $(".qty-nav-thumb").slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: ".qty-product-cover",
                    focusOnSelect: !0,
                })
            }
        });
    }

    function getVaiantPriceColorData(product_group_id, color) {
        var quanity = $('#quantity').val();
        $.ajax({
            type: "GET",
            url: '{{ route('product.get_varinat_price_data') }}',
            data: {
                product_group_id: product_group_id,
                color: color,
                product_qty: quanity,
                type: 'model'
            },
            success: function(data) {
                $('#modal_body').empty();
                $('#modal_body').html(data);
                $(".qty-product-cover").slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: !1,
                    fade: !1,
                    asNavFor: ".qty-nav-thumb"
                }), $(".qty-nav-thumb").slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: ".qty-product-cover",
                    focusOnSelect: !0,
                })
            }
        });
    }



</script>
