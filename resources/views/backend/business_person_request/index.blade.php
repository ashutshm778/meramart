@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Business Person Request List</li>
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
                                <h3 class="card-title">{{ucfirst(request()->type)}} Business Person Request List</h3>
                                <div class="card-tools">
                                    <form action="{{route('admin.business.person.request.index')}}">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input type="hidden" name="type" value="{{$type}}">
                                            <input type="text" name="key" value="{{$search}}" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
                                            <th class="text-center">GSTIN</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td>
                                                    <b>Name:</b> {{$data->first_name}} {{$data->last_name}} <br>
                                                    @if($data->owner_name)
                                                        <b>Owner:</b> {{$data->owner_name}}
                                                    @endif
                                                </td>
                                                <td class="text-center">{{$data->phone}}</td>
                                                <td class="text-center">{{ucwords($data->type)}}</td>
                                                <td class="text-center">{{$data->business_name}}</td>
                                                <td class="text-center">{{$data->brand_name}}</td>
                                                <td class="text-center">{{$data->gstin_number}}</td>
                                                <td class="text-center">
                                                    @if($data->verify_status == 0)
                                                        <a><span class="badge bg-warning">Pending</span></a>
                                                    @elseif($data->verify_status == 1)
                                                        <a><span class="badge bg-success">Approved</span></a>
                                                    @elseif($data->verify_status == 2)
                                                        <a><span class="badge bg-danger">cancel</span></a>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{$data->created_at}}</td>
                                                <td class="text-center">
                                                    @if($data->verify_status != 1)
                                                        <a href="{{route('admin.business.person.request.edit',$data->id).'?key='.$search.'&type='.request()->type.'&page='.$list->currentPage()}}" class="btn btn-outline-warning btn-sm mr-1 mb-1">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endif
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
                                    {!! $list->appends(['key'=>$search])->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
