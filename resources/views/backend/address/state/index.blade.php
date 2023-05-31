@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">State List</li>
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
                                <form action="{{route('admin.states.index')}}">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <select name="search_country" class="form-control select2">
                                                <option value="">Select Country</option>
                                                @foreach (App\Models\Admin\Country::orderBy('country','asc')->get() as $country)
                                                    <option value="{{$country->id}}" @if($search_country == $country->id) selected @endif>{{$country->country}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 input-group input-group-sm">
                                            <input type="text" name="search" value="{{$search}}" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Country</th>
                                            <th class="text-center">State</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($states as $key=>$state)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($states->currentPage() - 1)*$states->perPage()}}</td>
                                                <td class="text-center">{{$state->country->country}}</td>
                                                <td class="text-center">{{$state->state}}</td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.states.edit',$state->id).'?search='.$search.'&search_country='.$search_country.'&page='.$states->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.states.destroy',$state->id).'?search='.$search.'&search_country='.$search_country.'&page='.$states->currentPage()}}" onclick="return confirm('Are you sure you want to delete this State?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
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
                                    {!! $states->appends(['search'=>$search,'search_country'=>$search_country])->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Add State</h3>
                            </div>
                            <div class="card-body p-2">
                                <form action="{{route('admin.states.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            @isset($edit_data) <input type="hidden" name="id" value="{{$edit_data->id}}"> @endisset
                                            <label>Country</label>
                                            <select name="country_id" class="form-control select2" required>
                                                <option value="">Select Country</option>
                                                @foreach (App\Models\Admin\Country::orderBy('country','asc')->get() as $country)
                                                    <option value="{{$country->id}}" @isset($edit_data) @if($edit_data->country_id == $country->id) selected @endif @endisset>{{$country->country}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>State</label>
                                        <input type="text" name="state" class="form-control" @isset($edit_data) value="{{$edit_data->state}}" @endisset placeholder="Enter State Name..." required>
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

