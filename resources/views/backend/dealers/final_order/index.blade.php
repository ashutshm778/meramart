@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Dealer Final Order List</li>
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
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Order Id</th>
                                            <th class="text-center">Dealer Detail</th>
                                            <th class="text-center">Total Amount</th>
                                            <th class="text-center">Number Of Product</th>
                                            <th class="text-center">Order Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dealer_orders as $key=>$dealer_order)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($dealer_orders->currentPage() - 1)*$dealer_orders->perPage()}}</td>
                                                <td class="text-center">{{$dealer_order->order_id}}</td>
                                                <td>
                                                    <b>Name: </b>{{$dealer_order->dealer->first_name}} {{$dealer_order->dealer->last_name}} <br>
                                                    <b>Phone: </b>{{$dealer_order->dealer->phone}} <br>
                                                    <b>Email: </b>{{$dealer_order->dealer->email}}
                                                </td>
                                                <td class="text-center">{{$dealer_order->grand_total}}</td>
                                                <td class="text-center">{{$dealer_order->order_detail_count}}</td>
                                                <td class="text-center">{{$dealer_order->order_status}}</td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.dealer.final.order.detail',$dealer_order->order_id)}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i></a>
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
                                    {!! $dealer_orders->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
