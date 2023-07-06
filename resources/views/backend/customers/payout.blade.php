@extends('backend.include.header')
@section('content')

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
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Payment Type</th>
                                            <th class="text-center">Payment Detail</th>
                                            <th class="text-center">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($payouts as $key=>$payout)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($payouts->currentPage() - 1)*$payouts->perPage()}}</td>
                                                <td class="text-center">₹ {{$payout->amount}}</td>
                                                <td class="text-center">{{ucfirst($payout->payment_type)}}</td>
                                                <td class="text-center">{{$payout->payment_detail}}</td>
                                                <td class="text-center">{{$payout->created_at}}</td>
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
                                <hr>
                                <div class="row" style="margin: 0px;">
                                    <div class="col-md-4">
                                        <p><b>Showing {{($payouts->currentpage()-1)*$payouts->perpage()+1}} to {{(($payouts->currentpage()-1)*$payouts->perpage())+$payouts->count()}} of {{$payouts->total()}} Payouts</b></p>
                                    </div>
                                    <div class="col-md-8 d-flex justify-content-end">
                                        {!! $payouts->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
