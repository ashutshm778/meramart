@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h5>Ten Pair Income History</h5>
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
                        @php
                        $direct_commission_histories = App\Models\CommissionDirect::where('user_id',Auth::guard('customer')->user()->id)->where('direct_type',10)->groupBy('order_id')->orderBy('id','desc')->get();
                        @endphp
                        <div class="ec-vendor-card-header">
                            <h5>Ten Pair Income History</h5>
                            <div class="ec-header-btn">
                                Total Amount : {{App\Models\CommissionDirect::where('user_id',Auth::guard('customer')->user()->id)->where('direct_type',10)->get()->sum('commission')}}
                            </div>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Direct Type</th>
                                            <th scope="col">Commission Amount</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($direct_commission_histories as $commission_history)
                                            <tr>
                                                <td><span>{{$commission_history->created_at->format('d-M-Y h:i A')}}</span></td>
                                                <td><span>{{$commission_history->direct_type}}</span></td>
                                                <td> <span>2500</span></td>
                                                <td> <a href="{{route('user_ten_direct_commission_list',$commission_history->order_id)}}" class="btn btn-primary">View</a></td>
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
