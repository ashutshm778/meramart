@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Coupon List</li>
                        </ol>
                    </div>
                        <div class="col-sm-6">
                            <a href="{{ route('admin.coupons.create')}}" class="btn btn-success float-right"> Add Coupon<i class="fas fa-plus"></i></a>
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
                                <h3 class="card-title">Coupon List</h3>
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
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Code</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Discount</th>
                                            <th class="text-center">Is Active</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($coupons as $key=>$coupon)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($coupons->currentPage() - 1)*$coupons->perPage()}}</td>
                                                <td class="text-center">{{ucwords(str_replace('_',' ',$coupon->type))}}</td>
                                                <td class="text-center">
                                                    <img src="{{asset('public/'.api_asset($coupon->image))}}"  style="height:80px;width: 80px;margin-right: 10px;">
                                                    {{$coupon->code}}
                                                </td>
                                                <td class="text-center">
                                                    {{date('d-M-Y',$coupon->start_date)}} - {{date('d-M-Y',$coupon->end_date)}}
                                                </td>
                                                <td class="text-center">
                                                    @if($coupon->discount_type == 'amount')
                                                        ₹{{$coupon->discount}}
                                                    @else
                                                        {{$coupon->discount}}%
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($coupon->is_active == '1')
                                                        <a href="{{route('admin.coupons.status',[$coupon->id,0])}}" onclick="return confirm('Are you sure you want to deactive this Coupon?');">
                                                            <span class="badge bg-success">Active</span>
                                                        </a>
                                                    @else
                                                        <a href="{{route('admin.coupons.status',[$coupon->id,1])}}" onclick="return confirm('Are you sure you want to deactive this Coupon?');">
                                                            <span class="badge bg-danger">Deactive</span>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.coupons.edit',$coupon->id)}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form id="delete-form" action="{{route('admin.coupons.destroy',$coupon->id)}}" method="POST" onsubmit="return confirm('Are you want delete this Coupon!');">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
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
                                    {!! $coupons->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
