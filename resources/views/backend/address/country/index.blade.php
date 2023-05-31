@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Country List</li>
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
                                <h3 class="card-title">Country List</h3>
                                <div class="card-tools">
                                    <form action="{{route('admin.countries.index')}}">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input type="text" name="search" value="{{$search}}" class="form-control float-right" placeholder="Search">
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
                                            <th class="text-center">Country</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($countries as $key=>$country)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($countries->currentPage() - 1)*$countries->perPage()}}</td>
                                                <td class="text-center">{{$country->country}}</td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.countries.edit',$country->id).'?search='.$search.'&page='.$countries->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.countries.destroy',$country->id).'?search='.$search.'&page='.$countries->currentPage()}}" onclick="return confirm('Are you sure you want to delete this Country?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
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
                                    {!! $countries->appends(['search'=>$search])->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Add Country</h3>
                            </div>
                            <div class="card-body p-2">
                                <form action="{{route('admin.countries.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            @isset($edit_data) <input type="hidden" name="id" value="{{$edit_data->id}}"> @endisset
                                            <label>Country</label>
                                            <input type="text" name="country" id="country" class="form-control" @isset($edit_data) value="{{$edit_data->country}}" @endisset placeholder="Enter Country Name...">
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

