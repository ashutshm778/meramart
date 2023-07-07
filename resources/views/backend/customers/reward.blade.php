@extends('backend.include.header')
@section('content')
@php

function check_rewards($total_id,$one_side_count,$other_side_count)
{
    $customer = Auth::guard('customer')->user();
    if (!empty($customer->referral_code)) {
        $customer_data = Customer::where('refered_by', $customer->referral_code)->first();
        if ($customer_data->pv() >= $total_id) {
            $one_side = '';
            foreach ($customer_data as $customer_referral) {
                $customer_referral_data = Customer::where('refered_by', $customer_referral->referral_code)->get();
                if ($customer_referral_data->count() == $one_side_count) {
                    $one_side = $customer_referral_data->id;
                }
            }
            $other_side = 0;
            $other_side_id = [];
            foreach ($customer_data->where('id', '!=', $one_side) as $customer_referral) {
                if (!empty($one_side) && ($other_side < $other_side_count)) {
                    $customer_referral_data = Customer::where('refered_by', $customer_referral->referral_code)->get();
                    $other_side = $other_side + $customer_referral_data->count();
                    array_push($other_side_id, $customer_referral->id);
                }
            }
            if ($other_side == $other_side_count) {
                echo 'Achived';
            } else {
                echo 'Not Achived';
            }
        }
    }
}

@endphp
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">
                                @isset($page_title)
                                    {{$page_title}}
                                @endisset
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6 text-right">
                        <b>Name: </b>{{$customer->first_name}} {{$customer->last_name}} <br>
                        <b>Phone: </b>{{$customer->phone}}
                        @if($customer->email)
                            <br>
                            <b>Email: </b>{{$customer->email}}
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-body table-responsive p-2" id="table">
                                <table class="table table-bordered table-striped">
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
                                                    <span class="text-danger">{{check_rewards($reward->total_id,$reward->one_side_id,$reward->other_side_id)}}</span>
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
        </section>
    </div>

@endsection
