@extends('frontend.layouts.app')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">User Profile</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Profile</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- User profile section -->
    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                @include('frontend.user_sidebar')

                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ec-vendor-block-profile">
                                        <div class="ec-vendor-block-img space-bottom-30">
                                            <div class="ec-vendor-block-detail">
                                                <img class="v-img" src="@if(Auth::guard('customer')->user()->photo) {{asset('public/public/frontend/user_profile/'.Auth::guard('customer')->user()->photo)}} @else {{asset('public/public/frontend/assets/images/149071.png')}} @endif" alt="vendor image">
                                                <h5 class="name">{{Auth::guard('customer')->user()->first_name}} {{Auth::guard('customer')->user()->last_name}}</h5>
                                                {{-- <p>( Business Man )</p> --}}
                                            </div>
                                            @if(session()->has('success'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('success') }}
                                                </div>
                                            @endif
                                            @if($errors->any())
                                                <div class="alert alert-danger" style="color: #ffffff;background-color: #b30606bd;border-color: #530000;">
                                                    {{ implode('', $errors->all(':message')) }}
                                                </div>
                                            @endif
                                            <p>Hello <span>{{Auth::guard('customer')->user()->first_name}} {{Auth::guard('customer')->user()->last_name}}</span></p>
                                            <p>From your account you can easily view and track orders. You can manage and change your account information like address, contact information and history of orders.</p>
                                        </div>
                                        <div class="ec-vendor-upload-detail">
                                            <form class="row" action="{{route('update.user.profile')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-6">
                                                    <label class="form-label">First name</label>
                                                    <input type="text" class="form-control" name="first_name" value="{{Auth::guard('customer')->user()->first_name}}">
                                                    @if ($errors->has('first_name'))
                                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Last name</label>
                                                    <input type="text" class="form-control" name="last_name" value="{{Auth::guard('customer')->user()->last_name}}">
                                                    @if ($errors->has('last_name'))
                                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Email id</label>
                                                    <input type="text" class="form-control" name="email" value="{{Auth::guard('customer')->user()->email}}">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Phone number</label>
                                                    <input type="text" class="form-control" value="{{Auth::guard('customer')->user()->phone}}" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Photo</label>
                                                    <input type="file" class="form-control" name="photo" accept="image/*">
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End User profile section -->

    @endsection
