@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Sales Members List</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('admin.sales.team.create') }}" class="btn btn-success float-right"> Create Sales Member <i class="fas fa-plus"></i></a>
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
                                <h3 class="card-title">Sales Members List</h3>
                            </div>
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key => $data)
                                            <tr>
                                                <td>{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->phone }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>
                                                    <a class="btn btn-outline-success btn-sm mr-1 mb-1 mt-1" href="{{route('admin.assign.target.index',$data->id)}}">
                                                        <i class="fas fa-bullseye"></i>
                                                    </a>
                                                    <a class="btn btn-outline-primary btn-sm mr-1 mb-1 mt-1" href="{{route('admin.sales.team.edit',$data->id)}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-sm mr-1 mb-1 mt-1" href="#">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="footable-empty">
                                                <td colspan="15">
                                                <center style="padding: 70px;"><i class="far fa-frown" style="font-size: 100px;"></i><br><h2>Nothing Found</h2></center>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {!! $list->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
