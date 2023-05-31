@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Offer List</li>
                        </ol>
                    </div>
                        <div class="col-sm-6">
                            <a href="{{ route('admin.offers.create')}}" class="btn btn-success float-right"> Add Offer <i class="fas fa-plus"></i></a>
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
                                    <div class="col-md-2">
                                        <h3 class="card-title">Offer List</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Start Date</th>
                                            <th class="text-center">End Date</th>
                                            <th class="text-center">No. Of Product</th>
                                            <th class="text-center">Is Featured</th>
                                            <th class="text-center">Is Active</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td class="text-center">{{ucwords(str_replace('_',' ',$data->type))}}</td>
                                                <td class="text-center">{{$data->title}}</td>
                                                <td class="text-center"><img src="{{asset('public/'.api_asset($data->image))}}" style="height: 100px;width: 100px;"></td>
                                                <td class="text-center">{{$data->start_date_time}}</td>
                                                <td class="text-center">{{$data->end_date_time}}</td>
                                                <td class="text-center">{{$data->offer_product_count}}</td>
                                                <td class="text-center">
                                                    @if($data->is_featured)
                                                        <a href="{{route('admin.offers.show',$data->id)}}?featured=0" onclick="return confirm('Are you sure you want to not Feature this category?');">
                                                            <span class="badge bg-success">Featured</span>
                                                        </a>
                                                    @else
                                                        <a href="{{route('admin.offers.show',$data->id)}}?featured=1" onclick="return confirm('Are you sure you want to not Feature this category?');">
                                                            <span class="badge bg-danger">Not Featured</span>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($data->is_active)
                                                        <a href="{{route('admin.offers.show',$data->id)}}?active=0" onclick="return confirm('Are you sure you want to not Feature this category?');">
                                                            <span class="badge bg-success">Active</span>
                                                        </a>
                                                    @else
                                                        <a href="{{route('admin.offers.show',$data->id)}}?active=1" onclick="return confirm('Are you sure you want to not Feature this category?');">
                                                            <span class="badge bg-danger">Not Active</span>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.offers.edit',$data->id)}}" class="btn btn-outline-primary btn-sm mb-1" style="width:32px;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.offers.destroy',$data->id)}}" onclick="return confirm('Are you sure you want to delete this Offer?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
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
