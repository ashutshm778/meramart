@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Level Team</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Team</li>
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
                            <h5>Team</h5>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Total PV </th>
                                            <th class="text-center">Total BV </th>
                                            <th class="text-center">Join Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teams as $key=>$team)
                                            <tr>
                                                <td class="text-center">{{$key+1}}</td>
                                                <td class="text-center">{{$team->order->customer->first_name}} {{$team->order->customer->last_name}}</td>
                                                <td class="text-center">{{$team->order->customer->phone}}</td>
                                                @php

                                                    $order_data=App\Models\Order::where('user_id', $team->order->user_id)->where('payment_status','success')->get();
                                                    $total_pv=0;
                                                    foreach($order_data as $data){
                                                     foreach($data->order_details as $order_detail){
                                                      $total_pv= $total_pv + ($order_detail->pv *  $order_detail->quantity);
                                                      }
                                                     }

                                                @endphp
                                                <td class="text-center">{{$total_pv}}</td>
                                                <td class="text-center">{{$total_pv/40}}</td>
                                                <td class="text-center">{{$team->order->customer->created_at}}</td>
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
