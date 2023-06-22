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
                            <h5>Product History</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="{{route('index')}}">Shop Now</a>
                            </div>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Order Status</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $order_histories = App\Models\Order::where('user_id',Auth::guard('customer')->user()->id)->orderby('id','desc')->paginate(10);
                                        @endphp
                                        @foreach ($order_histories as $order_history)
                                            <tr>
                                                <th scope="row"><span>{{$order_history->order_id}}</span></th>
                                                <td><span>{{$order_history->created_at->format('d-M-Y h:i A')}}</span></td>
                                                <td><span>{{$order_history->grand_total}}</span></td>
                                                <td><span>Pending</span></td>
                                                <td><span>{{ucFirst($order_history->payment_status)}}</span></td>
                                                <td>
                                                    <span class="tbl-btn"><a class="btn btn-lg btn-primary" href="{{route('user_history_details',$order_history->id)}}">View</a></span>
                                                </td>
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
