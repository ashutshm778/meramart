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
                                            <th class="text-center">Level</th>
                                            <th class="text-center">Income</th>
                                            <th class="text-center">Total Team</th>
                                            <th class="text-center">My Income</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($final_arr as $key=>$final_ar)
                                            <tr>
                                                <td class="text-center">{{$final_ar['level']}}</td>
                                                <td class="text-center">{{$final_ar['income']}}</td>
                                                <td class="text-center">{{$final_ar['total_team']}}</td>
                                                <td class="text-center">{{$final_ar['my_income']}}</td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.customer.level.team',[encrypt($customer->id),$final_ar['level']])}}" class="btn btn-outline-primary btn-sm mr-1 mb-1" title="Teams"><i class="fas fa-users"></i></a>
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
        </section>
    </div>

@endsection
