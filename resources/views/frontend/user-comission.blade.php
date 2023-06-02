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
                            <h5>Comission History</h5>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">User Details</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Commission Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $commission_histories = App\Models\Commission::where('user_id',Auth::guard('customer')->user()->id)->orderby('id','desc')->paginate(10);
                                        @endphp
                                        @foreach ($commission_histories as $commission_history)
                                            <tr>
                                                <td><span>{{$commission_history->created_at->format('d-M-Y h:i A')}}</span></td>
                                                <td><span>{{$commission_history->order->order_id}}</span></td>
                                                <td><span>{{$commission_history->order->customer->first_name}}</span><br>{{$commission_history->order->customer->phone}}</td>
                                                <td><span>{{$commission_history->level}}</span></td>
                                                <td> <span>{{$commission_history->commission}}</span></td>
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