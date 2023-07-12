@extends('frontend.layouts.app')
@section('content')
    @php

    function check_rewards($total_id,$one_side_count,$other_side_count)
    {
        $customer = Auth::guard('customer')->user();
        if (!empty($customer->referral_code)) {
            if ($customer->pv >= $total_id) {
                $customer_data =  App\Models\Customer::where('refered_by', $customer->referral_code)->get();
                $one_side = '';
                foreach ($customer_data as $customer_referral) {
                    if ($customer_referral->pv == $one_side_count) {
                        $one_side = $customer_referral->id;
                    }
                }
                $other_side = 0;
                $other_side_id = [];
                foreach (App\Models\Customer::where('refered_by', $customer->referral_code)->where('id', '!=', $one_side) as $customer_referrals) {
                    if (!empty($one_side) && ($other_side < $other_side_count)) {
                        $other_side = $other_side + $customer_referrals->pv;
                        array_push($other_side_id, $customer_referrals->id);
                    }
                }
                if ($other_side >= $other_side_count) {
                    echo 'Achived';
                } else {
                    echo 'Not Achived';
                }
            }else {
                    echo 'Not Achived';
                }
        }
    }

    @endphp
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Reward History</h2>
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
                            <h5>Reward Income History</h5>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Reward Name</th>
                                            <th class="text-center">100% ID</th>
                                            <th class="text-center">1 Site (60%)</th>
                                            <th class="text-center">Other Site (40%)</th>
                                            <th class="text-center">R. Product</th>
                                            <th class="text-center">Reward</th>
                                            <th class="text-center">Achived/Not Achived</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rewards as $key=>$reward)
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td class="text-center">{{$reward->name}}</td>
                                            <td class="text-center">{{$reward->total_id}}</td>
                                            <td class="text-center">{{$reward->one_side_id}}</td>
                                            <td class="text-center">{{$reward->other_side_id}}</td>
                                            <td class="text-center">{{$reward->product_name}}</td>
                                            <td class="text-center">{{$reward->amount}}</td>
                                            <td class="text-center">
                                                <span class="text-danger">{{check_rewards($reward->total_id,$reward->one_side_id,$reward->other_side_id)}} </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="footable-empty">
                                            <td colspan="11">
                                            <center style="padding: 70px;"><i class="far fa-frown" style="font-size: 100px;"></i><br><h2>Nothing Found</h2></center>
                                            </td>
                                        </tr>
                                    @endforelse
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
