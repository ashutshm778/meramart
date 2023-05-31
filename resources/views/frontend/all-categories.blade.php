@extends('frontend.layouts.app')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">All Categories</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">All Categories</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec About Us page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-2 col-xs-4">
                        <div class="ec_cat_inner">
                            @php
                                if(request()->type = 'brand')
                                {
                                    $brd = App\Models\Admin\Brnad::where('slug',request()->segment(1))->first();
                                    $brand_id = optional($brd)->id;
                                    if($brd){
                                        $cat_img = '';
                                        foreach($brd->cat_id as $key=>$cat)
                                        {
                                            if($category->id == $cat)
                                            {
                                                $cat_img = $brd->cat_img[$key];
                                            }
                                        }
                                    }
                                }
                                else {
                                    $brand_id = '';
                                }
                            @endphp
                            <div class="ec-cat-image">
                                <a href="{{ route('sub.categories',$category->id) }}?brand={{$brand_id}}"> <img @isset($cat_img) @if($cat_img) src="{{asset('public/'.api_asset($cat_img))}}" @else src="{{asset('public/'.api_asset($category->icon))}}" @endif @else src="{{asset('public/'.api_asset($category->icon))}}" @endisset alt="" /></a>
                            </div>
                            <div class="ec-cat-descs">
                                <a href="{{ route('sub.categories',$category->id) }}?brand={{$brand_id}}" class="text-center">{{$category->name}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
         </div>
    </section>



    @endsection
