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
                                            <hr>

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
                                                <div class="col-md-6">
                                                    <label class="form-label">Birth Of Birth</label>
                                                    <input type="date" class="form-control" name="dob" value="{{Auth::guard('customer')->user()->dob}}">
                                                    @if ($errors->has('dob'))
                                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                                    @endif
                                                </div>
                                                @if(featureActivation('mlm') == '1' && !empty(Auth::guard('customer')->user()->refered_by))
                                                @if(Auth::guard('customer')->user()->verify_status==1)
                                                   <div class="col-md-6">
                                                      <label class="form-label">Referral Code</label>
                                                      <input type="text" class="form-control" value="{{Auth::guard('customer')->user()->referral_code}}" readonly>
                                                    </div>
                                                 @endif
                                                    <div class="col-md-6">
                                                        <label class="form-label">Referral By</label>
                                                        <input type="text" class="form-control" value="{{Auth::guard('customer')->user()->refered_by}}" readonly>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <label class="form-label">Referral By Name</label>
                                                        <input type="text" class="form-control" value="{{optional(App\Models\Customer::where('referral_code',Auth::guard('customer')->user()->refered_by)->first())->first_name}} {{optional(App\Models\Customer::where('referral_code',Auth::guard('customer')->user()->refered_by)->first())->last_name}}" readonly>
                                                      </div>
                                                @endif
                                                <div class="col-md-12">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control" name="address" value="{{Auth::guard('customer')->user()->address}}">
                                                    @if ($errors->has('address'))
                                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Bank Name</label>
                                                    <input type="text" class="form-control" name="bank_name" value="{{Auth::guard('customer')->user()->bank_name}}">
                                                    @if ($errors->has('bank_name'))
                                                        <span class="text-danger">{{ $errors->first('bank_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Branch Name</label>
                                                    <input type="text" class="form-control" name="branch" value="{{Auth::guard('customer')->user()->branch}}">
                                                    @if ($errors->has('branch'))
                                                        <span class="text-danger">{{ $errors->first('branch') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Account Number</label>
                                                    <input type="text" class="form-control" name="account_number" value="{{Auth::guard('customer')->user()->account_number}}">
                                                    @if ($errors->has('account_number'))
                                                        <span class="text-danger">{{ $errors->first('account_number') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Bank Account Name</label>
                                                    <input type="text" class="form-control" name="bank_account_name" value="{{Auth::guard('customer')->user()->bank_account_name}}">
                                                    @if ($errors->has('bank_account_name'))
                                                        <span class="text-danger">{{ $errors->first('bank_account_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">IFSC Code</label>
                                                    <input type="text" class="form-control" name="ifsc_code" value="{{Auth::guard('customer')->user()->ifsc_code}}">
                                                    @if ($errors->has('ifsc_code'))
                                                        <span class="text-danger">{{ $errors->first('ifsc_code') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Nominee Name</label>
                                                    <input type="text" class="form-control" name="nominee_name" value="{{Auth::guard('customer')->user()->nominee_name}}">
                                                    @if ($errors->has('nominee_name'))
                                                        <span class="text-danger">{{ $errors->first('nominee_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Nominee Relation</label>
                                                    <input type="text" class="form-control" name="nominee_relation" value="{{Auth::guard('customer')->user()->nominee_relation}}">
                                                    @if ($errors->has('nominee_relation'))
                                                        <span class="text-danger">{{ $errors->first('nominee_relation') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Nominee Date of Birth</label>
                                                    <input type="date" class="form-control" name="nominee_dob" value="{{Auth::guard('customer')->user()->nominee_dob}}">
                                                    @if ($errors->has('nominee_dob'))
                                                        <span class="text-danger">{{ $errors->first('nominee_dob') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Aadhaar No</label>
                                                    <input type="number" class="form-control" name="aadhaar_no" value="{{Auth::guard('customer')->user()->aadhaar_no}}">
                                                    @if ($errors->has('aadhaar_no'))
                                                        <span class="text-danger">{{ $errors->first('aadhaar_no') }}</span>
                                                    @endif
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Aadhar Image Front</label>
                                                    <input type="file" class="form-control" name="aadhaar_front_image" accept="image/*">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Aadhar Image Back</label>
                                                    <input type="file" class="form-control" name="aadhaar_back_image" accept="image/*">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Pan No</label>
                                                    <input type="number" class="form-control" name="pan_no" value="{{Auth::guard('customer')->user()->pan_no}}">
                                                    @if ($errors->has('pan_no'))
                                                        <span class="text-danger">{{ $errors->first('pan_no') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Pan Image</label>
                                                    <input type="file" class="form-control" name="pan_image" accept="image/*">
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
