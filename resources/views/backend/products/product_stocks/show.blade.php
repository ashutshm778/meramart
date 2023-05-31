@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Product Stock List</li>
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
                                <h3 class="card-title">Stock List</h3>
                                <div class="card-tools">
                                    <form action="#">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input type="text" name="key" value="" class="form-control float-right" placeholder="Search">
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
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Vendor</th>
                                            <th class="text-center">Purchase Price</th>
                                            <th class="text-center">Current Stock</th>
                                            <th class="text-center">Last Added Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td class="text-center">
                                                    <img src="{{asset('public/'.api_asset($data->product->thumbnail_image))}}" style="height:80px;width: 80px;margin-right: 10px;">
                                                </td>
                                                <td class="text-center">{{$data->product->name}}</td>
                                                <td class="text-center">
                                                    <b>Owner Name:</b> {{$data->vendor->owner_name}}<br>
                                                    <b>Business Name:</b> {{$data->vendor->business_name}}<br>
                                                    <b>Phone:</b> {{$data->vendor->phone}}
                                                </td>
                                                <td class="text-center">{{$data->purchase_price}}</td>
                                                <td class="text-center">{{$data->current_stock}}</td>
                                                <td class="text-center">{{$data->created_at->format('d-M-Y')}}</td>
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
