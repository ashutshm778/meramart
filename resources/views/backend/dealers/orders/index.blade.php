@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Dealer Order List</li>
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
                                {{-- <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3">
                                        <select name="search_payment_status" class="form-control" id="search_payment_status">
                                            <option value="">Select Payment Status...</option>
                                            <option value="unpaid">Unpaid</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="search_delivery_status" class="form-control" id="search_delivery_status">
                                            <option value="">Select Delivery Status...</option>
                                            <option value="pending">Pending</option>
                                            <option value="confirmed">Confirmed</option>
                                            <option value="on_delivery">On Delivery</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="cancel">Cancel</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 p-0">
                                        <input type="text" class="form-control" name="search" placeholder="Order ID, Phone, Email...">
                                    </div>
                                    <div class="col-md-1 p-0">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Order ID</th>
                                            <th class="text-center">Dealer Details</th>
                                            <th class="text-center">Sales Member Details</th>
                                            <th class="text-center">Grand Total</th>
                                            <th class="text-center">Total Product</th>
                                            <th class="text-center">Request Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dealer_order_requests as $key=>$dealer_order_request)
                                            <tr>
                                                @php
                                                    $orders = App\Models\DealerOrderRequest::where('order_request_id',$dealer_order_request->order_request_id);
                                                @endphp
                                                <td class="text-center">{{($key+1) + ($dealer_order_requests->currentPage() - 1)*$dealer_order_requests->perPage()}}</td>
                                                <td class="text-center">{{$dealer_order_request->order_request_id}}</td>
                                                <td class="text-left">
                                                    <b>Name: </b>{{$dealer_order_request->dealer->first_name}} {{$dealer_order_request->dealer->last_name}}<br>
                                                    <b>Phone: </b>{{$dealer_order_request->dealer->phone}} <br>
                                                    <b>Email: </b>{{$dealer_order_request->dealer->email}} <br>
                                                    <b>Type: </b>{{ucfirst($dealer_order_request->dealer->type)}} <br>
                                                </td>
                                                <td class="text-left">
                                                    <b>Name: </b>{{$dealer_order_request->sales_member->name}}<br>
                                                    <b>Phone: </b>{{$dealer_order_request->sales_member->phone}} <br>
                                                    <b>Email: </b>{{$dealer_order_request->sales_member ->email}} <br>
                                                </td>
                                                <td class="text-center">{{$orders->sum('product_discount_amount')}}</td>
                                                <td class="text-center">{{$orders->count()}}</td>
                                                <td class="text-center">
                                                    {{ucfirst($dealer_order_request->request_status)}}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.dealer.order.detail',$dealer_order_request->order_request_id)}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-eye"></i>
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
                                    {!! $dealer_order_requests->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
