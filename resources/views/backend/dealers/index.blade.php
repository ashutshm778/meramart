@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Dealer List</li>
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
                                <h3 class="card-title">Dealers</h3>
                            </div>
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Business Name</th>
                                            <th class="text-center">Brand Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dealers as $key=>$dealer)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($dealers->currentPage() - 1)*$dealers->perPage()}}</td>
                                                <td>
                                                    <b>Name:</b> {{$dealer->first_name}} {{$dealer->last_name}} <br>
                                                    @if($dealer->businessDetail->owner_name)
                                                        <b>Owner:</b> {{$dealer->businessDetail->owner_name}}
                                                    @endif
                                                </td>
                                                <td class="text-center">{{$dealer->phone}}</td>
                                                <td class="text-center">{{ucwords($dealer->type)}}</td>
                                                <td class="text-center">{{$dealer->businessDetail->business_name}}</td>
                                                <td class="text-center">{{$dealer->businessDetail->brand_name}}</td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.assign.dealer.target.index',$dealer->id)}}" class="btn btn-outline-success btn-sm mr-1 mb-1">
                                                        <i class="fas fa-bullseye"></i>
                                                    </a>
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
                                <div class="d-flex justify-content-center mt-3">
                                    {!! $dealers->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
