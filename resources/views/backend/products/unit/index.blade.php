@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{$page_title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">{{$page_title}}</h3>
                                <div class="card-tools">
                                    <form action="{{route('admin.units.index')}}">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input type="text" name="search" value="{{$search_key}}" class="form-control float-right" placeholder="Search">
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
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($units as $key=>$unit)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($units->currentPage() - 1)*$units->perPage()}}</td>
                                                <td class="text-center">{{$unit->name}}</td>
                                                <td class="text-center">
                                                    <div class="row">
                                                        <div class="col-md-6 d-flex justify-content-end">
                                                            <a href="{{route('admin.units.edit',$unit->id)}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 d-flex justify-content-start">
                                                            <form id="delete-form" action="{{route('admin.units.destroy',$unit->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Unit?');">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
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
                                    {!! $units->appends(['search_key'=>$search_key])->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Add Unit</h3>
                            </div>
                            <div class="card-body p-2">
                                <form action="{{route('admin.units.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            @isset($edit_data) <input type="hidden" name="id" value="{{$edit_data->id}}"> @endisset
                                            <label>Name</label>
                                            <input type="text" name="name" id="name" class="form-control" @isset($edit_data) value="{{$edit_data->name}}" @endisset placeholder="Enter Unit Name...">
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 text-center pt-4">
                                            <button class="btn btn-primary">@isset($edit_data) Update @else Add @endisset</button>
                                        </div>
                                        <div class="col-md-4"></div>
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

