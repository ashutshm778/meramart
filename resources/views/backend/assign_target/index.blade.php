@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Assign Target List</li>
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
                                        <h3 class="card-title">Assign Target</h3>
                                    </div>
                                    <div class="col-md-3">
                                        @php
                                            $sales_member_details=App\Models\User::where('id',$sales_member_id)->first();
                                        @endphp
                                        <h3>Sales Member Details</h3>
                                        <b>Name: </b>{{$sales_member_details->name}} <br>
                                        <b>Phone: </b>{{$sales_member_details->phone}} <br>
                                        <b>Email: </b>{{$sales_member_details->email}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-2">
                                <form action="{{route('admin.assign.target.store')}}" method="post">
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
                                                        $assign_target = App\Models\Admin\AssignTarget::where('sales_member_id',$sales_member_id)->where('month',$month)->where('year',$year)->first();
                                                        $target_amount = $assign_target->target_amount ?? 0;
                                                        $achive_target_amount = $assign_target->achive_target_amount ?? 0;
                                                    @endphp
                                                    <tr>
                                                            <td>
                                                                {{$month}} - {{$year}}
                                                                <input type="hidden" name="month[]" value="{{$month}}">
                                                                <input type="hidden" name="year[]" value="{{$year}}">
                                                                <input type="hidden" name="sales_member_id" value="{{$sales_member_id}}">
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
