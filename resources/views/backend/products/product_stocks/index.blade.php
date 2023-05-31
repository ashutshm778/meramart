@extends('backend.include.header')
@section('content')

<style>

.sub-cat
{
    list-style: none;
    margin: 0;
    padding: 0;

}

.sub-cat li
{

    width: 19.6%;
    display: inline-block;
}

</style>

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
                        <div class="col-sm-6">
                            <a href="{{ route('admin.product-stocks.create')}}" class="btn btn-success float-right"> Add Stock<i class="fas fa-plus"></i></a>
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
                                            <th class="text-center">Vendor</th>
                                            <th class="text-center">Total Purchase Price</th>
                                            <th class="text-center">Total Purchase Stock</th>
                                            <th class="text-center">Last Added Stock</th>
                                            <th class="text-center">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td>
                                                    <b>Owner Name:</b> {{$data->vendor->owner_name}}<br>
                                                    <b>Business Name:</b> {{$data->vendor->business_name}}<br>
                                                    <b>Phone:</b> {{$data->vendor->phone}}
                                                </td>
                                                <td class="text-center">{{App\Models\Admin\ProductStock::where('pi_number',$data->pi_number)->sum('purchase_price')}}</td>
                                                <td class="text-center">{{App\Models\Admin\ProductStock::where('pi_number',$data->pi_number)->sum('current_stock')}}</td>
                                                <td class="text-center">{{$data->created_at->format('d-M-Y h:i A')}}</td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.product-stocks.show',$data->pi_number)}}">
                                                        <i class="btn btn-primary fas fa-eye"></i>
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
