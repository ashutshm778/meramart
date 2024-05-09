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
                            <h5>Wallet History</h5>
                            <div class="ec-header-btn">
                                Balance : {{Auth::guard('customer')->user()->balance}}
                            </div>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Transaction Type</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $transaction_histories = App\Models\CustomerWallet::where('user_id',Auth::guard('customer')->user()->id)->orderby('id','asc')->get();
                                        @endphp
                                        @foreach ($transaction_histories as $transaction_history)
                                            <tr>
                                                <td><span>{{$transaction_history->created_at->format('d-M-Y h:i A')}}</span></td>
                                                <td><span>{{$transaction_history->amount}}</span></td>
                                                <td><span>{{ucFirst($transaction_history->transaction_type)}}</span></td>
                                                <td><span>{{$transaction_history->transaction_detail}}</span></td>
                                                <td> <span>{{$transaction_history->balance}}</span></td>
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
