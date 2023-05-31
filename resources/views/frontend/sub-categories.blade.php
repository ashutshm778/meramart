@extends('frontend.layouts.app')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">{{App\Models\Admin\Category::where('id',$category_id)->first()->name}}</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">{{App\Models\Admin\Category::where('id',$category_id)->first()->name}}</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Sub Categories page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
           {{-- <div class="row">
                <div class="ec-common-wrapper">
                        <div class="col-md-12 ec-cms-block ec-abcms-block text-center">
                            <div class="ec-cms-block-inner pt-2">
                                <h3 class="ec-cms-block-title">{{App\Models\Admin\Category::where('id',$category_id)->first()->name}}</h3>
                                <p>{!!App\Models\Admin\Category::where('id',$category_id)->first()->description!!}</b></p>

                            </div>
                        </div>
                </div>
            </div> --}}
            <div class="row">
                @foreach($sub_categories as $sub)
                    <div class="col-md-2 col-xs-4">
                        <div class="ec_cat_inner">
                            <div class="ec-cat-image">
                                <a href="{{ route('search',$sub->slug) }}?type=subcategory&brand={{request()->brand}}"> <img src="{{asset('public/'.api_asset($sub->image))}}" alt="" /></a>
                            </div>
                            <div class="ec-cat-descs">
                                <a href="{{ route('search',$sub->slug) }}?type=subcategory&brand={{request()->brand}}" class="text-center">{{$sub->name}}</a>
                            </div>
                        </div>
                    </div>
               @endforeach
            </div>
        </div>
    </section>
    @endsection
