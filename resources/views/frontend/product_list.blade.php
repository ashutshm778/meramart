@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Shop</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Shop</li>
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
                <div class="ec-shop-rightside col-lg-9 order-lg-last col-md-12 order-md-first margin-b-30">
                    <div class="ec-pro-list-top d-flex">
                        <div class="col-md-6 ec-grid-list">
                            <div class="col header-top-res d-lg-none">
                                <div class="ec-header-bottons">
                                    <a href="#ec-filters" class="ec-header-btn ec-side-toggle text-dark d-lg-none">
                                        <i class="ecicon eci-filter text-dark"></i>&nbsp; Filters
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ec-sort-select">
                            <span class="sort-by">Sort by</span>
                            <form class="fillter">
                                <div class="ec-select-inner">
                                    <select name="sort_by" id="ec-select" onchange="filler_product()">
                                        <option value="asc" selected>Name, A to Z</option>
                                        <option value="desc">Name, Z to A</option>
                                        <option value="pasc">Price, low to high</option>
                                        <option value="pdesc">Price, high to low</option>
                                    </select>
                                    @if (request('type') == 'subcategory')
                                        <input type="hidden" name="subcat" value="{{$slug}}">
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="shop-pro-content" id="product_list_data">
                        @include('frontend.product_list_data')
                        <div class="kinetic" style="left: 40%;bottom: 80%; display: none"></div>
                    </div>
                </div>


                <div class="ec-shop-leftside col-lg-3 order-lg-first col-md-12 order-md-last d-none d-lg-block">
                    <div id="shop_sidebar">
                        <form class="fillter">
                            <div class="ec-sidebar-wrap">
                                @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                                    <div class="ec-sidebar-block">
                                        <div class="ec-sb-title">
                                            <h3 class="ec-sidebar-title">Price</h3>
                                        </div>
                                        <div class="ec-sb-block-content">
                                            <input type="hidden" name="search" value="{{request()->search}}">
                                            <ul>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="price_filler" value="1000-5000" onclick="filler_product()"> <a href="#">₹ 1,000 to ₹ 5,000</a>
                                                        <span class="checked"></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="price_filler" value="5000-10000" onclick="filler_product()"> <a href="#">₹ 5,000 to ₹ 10,000</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="price_filler" value="10000-20000" onclick="filler_product()"> <a href="#">₹ 10,000 to ₹ 20,000</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="price_filler" value="20000-50000" onclick="filler_product()"> <a href="#">₹ 20,000 to ₹ 50,000</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="price_filler" value="50000-100000" onclick="filler_product()"> <a href="#">₹ 50,000 to ₹ 1,00,000</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="price_filler" value="more than 100000" onclick="filler_product()"> <a href="#">More than ₹ 1,00,000</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="ec-sidebar-block">
                                    <div class="ec-sb-title">
                                        <h3 class="ec-sidebar-title">Category</h3>
                                    </div>
                                    <div class="ec-sb-block-content">
                                        <ul>
                                            @foreach (App\Models\Admin\Category::select('id','name')->where('is_active',1)->orderBy('priority','asc')->get() as $category)
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="checkbox" name="category_filler[]" value="{{$category->id}}" onclick="filler_product()" @if(request()->category_filler == $category->id) checked @endif> <a href="#">{{$category->name}}</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @php
                                    $colo_has=App\Models\Admin\Color::has('product')->get();
                                @endphp
                                @if(count($colo_has))
                                    <div class="ec-sidebar-block">
                                        <div class="ec-sb-title">
                                            <h3 class="ec-sidebar-title">Color</h3>
                                        </div>
                                        <div class="ec-sb-block-content">
                                            <ul>
                                                @foreach (App\Models\Admin\Color::has('product')->get() as $color)
                                                    <li>
                                                        <div class="ec-sidebar-block-item">
                                                            <input type="checkbox" name="color_filler[]" value="{{$color->code}}" onclick="filler_product()"> <a href="#">{{$color->name}}</a><span class="checked"></span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                                    <div class="ec-sidebar-block">
                                        <div class="ec-sb-title">
                                            <h3 class="ec-sidebar-title">Discount </h3>
                                        </div>
                                        <div class="ec-sb-block-content">
                                            <ul>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="discount_filler" value="10" onclick="filler_product()"> <a href="#">10% and Above</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="discount_filler" value="20" onclick="filler_product()"> <a href="#">20% and Above</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="discount_filler" value="30" onclick="filler_product()"> <a href="#">30% and Above</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="discount_filler" value="40" onclick="filler_product()"> <a href="#">40% and Above</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="discount_filler" value="50" onclick="filler_product()"> <a href="#">50% and Above</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="discount_filler" value="60" onclick="filler_product()"> <a href="#">60% and Above</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <div class="ec-sidebar-block">
                                    <div class="ec-sb-title">
                                        <h3 class="ec-sidebar-title">Brand </h3>
                                    </div>
                                    <div class="ec-sb-block-content">
                                        <ul>
                                            @foreach (App\Models\Admin\Brnad::where('is_active',1)->get() as $side_bar_brnad)
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="radio" name="brand_filler" value="{{$side_bar_brnad->id}}" onclick="filler_product()" @if(request()->brand == $side_bar_brnad->id) checked @endif> <a href="#">{{$side_bar_brnad->name}}</a><span class="checked"></span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <!--- Filters In Mobile View --->

    <div id="ec-filters" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">Filters</span>
            <button class="ec-close">×</button>
        </div>

        <div id="shop_sidebar">
            <form class="fillter">
                <div class="ec-sidebar-wrap" style="border:none">
                    @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Price</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <input type="hidden" name="search" value="{{request()->search}}">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="price_filler" value="1000-5000" onclick="filler_product()"> <a href="#">₹ 1,000 to ₹ 5,000</a>
                                            <span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="price_filler" value="5000-10000" onclick="filler_product()"> <a href="#">₹ 5,000 to ₹ 10,000</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="price_filler" value="10000-20000" onclick="filler_product()"> <a href="#">₹ 10,000 to ₹ 20,000</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="price_filler" value="20000-50000" onclick="filler_product()"> <a href="#">₹ 20,000 to ₹ 50,000</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="price_filler" value="50000-100000" onclick="filler_product()"> <a href="#">₹ 50,000 to ₹ 1,00,000</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="price_filler" value="more than 100000" onclick="filler_product()"> <a href="#">More than ₹ 1,00,000</a><span class="checked"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Category</h3>
                        </div>
                        <div class="ec-sb-block-content">
                            <ul>
                                @foreach (App\Models\Admin\Category::select('id','name')->where('is_active',1)->orderBy('priority','asc')->get() as $category)
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" name="category_filler[]" value="{{$category->id}}" onclick="filler_product()" @if(request()->category_filler == $category->id) checked @endif> <a href="#">{{$category->name}}</a><span class="checked"></span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @php
                        $colo_has=App\Models\Admin\Color::has('product')->get();
                    @endphp
                    @if(count($colo_has))
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Color</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    @foreach (App\Models\Admin\Color::has('product')->get() as $color)
                                        <li>
                                            <div class="ec-sidebar-block-item">
                                                <input type="checkbox" name="color_filler[]" value="{{$color->code}}" onclick="filler_product()"> <a href="#">{{$color->name}}</a><span class="checked"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Discount </h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="discount_filler" value="10" onclick="filler_product()"> <a href="#">10% and Above</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="discount_filler" value="20" onclick="filler_product()"> <a href="#">20% and Above</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="discount_filler" value="30" onclick="filler_product()"> <a href="#">30% and Above</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="discount_filler" value="40" onclick="filler_product()"> <a href="#">40% and Above</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="discount_filler" value="50" onclick="filler_product()"> <a href="#">50% and Above</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="discount_filler" value="60" onclick="filler_product()"> <a href="#">60% and Above</a><span class="checked"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Brand </h3>
                        </div>
                        <div class="ec-sb-block-content">
                            <ul>
                                @foreach (App\Models\Admin\Brnad::where('is_active',1)->get() as $side_bar_brnad)
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="radio" name="brand_filler" value="{{$side_bar_brnad->id}}" onclick="filler_product()" @if(request()->brand == $side_bar_brnad->id) checked @endif> <a href="#">{{$side_bar_brnad->name}}</a><span class="checked"></span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
<script src="{{ asset('public/dashboard_css/plugins/jquery/jquery.min.js') }}"></script>
<script>

    $(document).on('click', '.product_index a', function(event)
    {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        filler_product(page);
    });

    function filler_product(page)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('product.fillter')}}?&page=" + page,
            data: $('.fillter').serialize(),
            beforeSend: function(msg){
                $('.kinetic').show()
            },
            success: function(data) {
                $('.kinetic').hide()
                $('#product_list_data').html(data)
                $('html, body').animate({ scrollTop: 0 }, 'fast');
            }
        });
    }

</script>
