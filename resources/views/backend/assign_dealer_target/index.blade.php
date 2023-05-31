@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Assign Dealer Target List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3 class="card-title">Assign Dealer Target</h3>
                                    </div>
                                    <div class="col-md-3">
                                        @php
                                            $dealer_details=App\Models\Customer::where('id',$dealer_id)->first();
                                        @endphp
                                        <h3>Dealer Details</h3>
                                        <b>Name: </b>{{$dealer_details->first_name}} {{$dealer_details->last_name}} <br>
                                        @if($dealer_details->businessDetail->owner_name)
                                            <b>Owner:</b> {{$dealer_details->businessDetail->owner_name}} <br>
                                        @endif
                                        <b>Phone: </b>{{$dealer_details->phone}} <br>
                                        <b>Type: </b>{{ucwords($dealer_details->type)}} <br>
                                        <b>Business Name: </b>{{ucwords($dealer_details->businessDetail->business_name)}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-2">
                                <form action="{{route('admin.assign.dealer.target.store')}}" method="post">
                                    @csrf
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Month</th>
                                                <th>Target Amount</th>
                                                <th>Achive Target Amount</th>
                                                <th>Remaining Target Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($financial_years as $key => $financial_year)
                                                    @php
                                                        $month = date('F',strtotime($financial_year));
                                                        $year = date('Y',strtotime($financial_year));
                                                        $assign_dealer_target = App\Models\Admin\AssignDealerTarget::where('dealer_id',$dealer_id)->where('month',$month)->where('year',$year)->first();
                                                        $target_amount = $assign_dealer_target->target_amount ?? 0;
                                                        $achive_target_amount = $assign_dealer_target->achive_target_amount ?? 0;
                                                    @endphp
                                                    <tr>
                                                            <td>
                                                                {{$month}} - {{$year}}
                                                                <input type="hidden" name="month[]" value="{{$month}}">
                                                                <input type="hidden" name="year[]" value="{{$year}}">
                                                                <input type="hidden" name="dealer_id" value="{{$dealer_id}}">
                                                            </td>
                                                            <td>
                                                                <input type="number" step="0.01" name="target_amount[]" class="form-control" value="{{$target_amount}}">
                                                            </td>
                                                            <td>
                                                                <input type="number" step="0.01" name="achive_target_amount[]" class="form-control" value="{{$achive_target_amount}}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="number" step="0.01" name="remaining_target_amount[]" class="form-control" value="{{$target_amount - $achive_target_amount}}" readonly>
                                                            </td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
