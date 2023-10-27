@extends('frontend.layouts.app')
@section('content')
    @php

    function check_rewards($reward_id,$amount,$total_id,$one_side_count,$other_side_count)
    {
        if(!empty(App\Models\CustomerReward::where('user_id',Auth::guard('customer')->user()->id)->where('reward_id',$reward_id)->first())){
           return 'Achived';
        }
        $customer = Auth::guard('customer')->user();
        if (!empty($customer->referral_code)) {
            $customer_data =  App\Models\Customer::where('refered_by', $customer->referral_code)->get();

                $one_side = '';
                foreach ($customer_data as $customer_referral) {
                    if (empty($one_side) && ($customer_referral->total_pv >= $one_side_count)) {
                        $one_side = $customer_referral->id;
                    }
                }
                $other_side = 0;
                $other_side_id = [];
                foreach (App\Models\Customer::where('refered_by', $customer->referral_code)->where('id', '!=', $one_side)->get() as $customer_referrals) {
                    if (!empty($one_side) && ($other_side < $other_side_count)) {
                        $other_side = $other_side + $customer_referrals->total_pv;
                        array_push($other_side_id,['customer_id'=>$customer_referrals->id,'total_pv'=>$customer_referrals->total_pv] );
                    }
                }
                if ($other_side >= $other_side_count) {
                    $one_side_customer=App\Models\Customer::where('id',$one_side)->first();
                    $one_side_customer->total_pv=$one_side_customer->total_pv-$one_side_count;
                    //$one_side_customer->save();

                    foreach($other_side_id as $otherSideId){
                        $other_side_customer=App\Models\Customer::where('id',$otherSideId['customer_id'] )->first();
                        if($otherSideId['total_pv'] >= $other_side_count){
                            $other_side_customer->total_pv=$other_side_customer->total_pv-$other_side_count;
                        }else{
                            $other_side_customer->total_pv=$other_side_customer->total_pv-$otherSideId['total_pv'];
                        }
                        $other_side_customer->save();
                    }
                    $customer_reward_achive=new App\Models\CustomerReward;
                    $customer_reward_achive->user_id= $customer->id;
                    $customer_reward_achive->reward_id=$reward_id;
                   // $customer_reward_achive->save();

                    $customer->balance = $customer->balance + $amount;
                   // $customer->save();

                    $customer_wallet = new App\Models\CustomerWallet;
                    $customer_wallet->user_id =$customer->id;
                    $customer_wallet->amount = $amount;
                    $customer_wallet->transaction_type = 'credited';
                    $customer_wallet->transaction_detail = 'Amount Credited For Reward';
                    $customer_wallet->payment_details = '';
                    $customer_wallet->balance = $customer->balance;
                    $customer_wallet->approval = 0;
                   // $customer_wallet->save();

                    echo 'Achived';
                } else {
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
                                                <span >{{check_rewards($reward->id,$reward->amount,$reward->total_id,$reward->one_side_id,$reward->other_side_id)}} </span>
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
