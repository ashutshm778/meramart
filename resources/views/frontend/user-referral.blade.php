@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">User History</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">History</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                @include('frontend.user_sidebar')
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>User Referral</h5>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Earning</th>
                                            <th scope="col">Register Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $referral_users = App\Models\Customer::where('refered_by',Auth::guard('customer')->user()->referral_code)->orderby('id','desc')->get();
                                        @endphp
                                        @foreach ($referral_users as $referral_user)
                                            <tr>
                                                <td><span>{{$referral_user->first_name}}</span></td>
                                                <td><span>{{$referral_user->phone}}</span></td>
                                                <td><span>{{$referral_user->email}}</span></td>
                                                <td> <span>{{$referral_user->balance}}</span></td>
                                                <td><span>{{$referral_user->created_at->format('d-M-Y h:i A')}}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
