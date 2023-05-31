@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Vendor List</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{route('admin.vendors.create')}}" class="btn btn-success float-right"> Add Vendor <i class="fas fa-plus"></i></a>
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
                                <h3 class="card-title">Vendor List</h3>
                                <div class="card-tools">
                                    <form action="{{route('admin.vendors.index')}}">
                                        <div class="input-group input-group-sm" style="width: 200px;">
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
                                            <th class="text-center">Owner Name</th>
                                            <th class="text-center">Business Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Contact Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">GSTIN</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Account Detail</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td class="text-center">{{$data->owner_name}}</td>
                                                <td class="text-center">{{$data->business_name}}</td>
                                                <td class="text-center">{{$data->phone}}</td>
                                                <td class="text-center">{{$data->contact_name}}</td>
                                                <td class="text-center">{{$data->email}}</td>
                                                <td class="text-center">{{$data->gstin}}</td>
                                                <td class="text-center">{{$data->address}}</td>
                                                <td class="text-left">
                                                    <b>Holder Name: </b>{{$data->account_holder_name}} <br>
                                                    <b>Account Number: </b>{{$data->account_number}} <br>
                                                    <b>IFSC Code: </b>{{$data->ifsc_code}} <br>
                                                    <b>Branch Name: </b>{{$data->branch_name}}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.vendors.edit',$data->id)}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.vendors.destroy',$data->id)}}" class="btn btn-outline-danger btn-sm mr-1 mb-1">
                                                        <i class="fas fa-trash"></i>
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
