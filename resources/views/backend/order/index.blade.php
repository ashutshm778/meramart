@extends('backend.include.header')
@section('content')

    <style>
        .bg-confirmed
        {
            background-color: #ff6e07e3;
            color: #fff;
        }
    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Product List</li>
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
                                <div class="row">
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
                                </div>
                            </div>
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Order ID</th>
                                            <th class="text-center">Customer Details</th>
                                            <th class="text-center">Grand Total</th>
                                            <th class="text-center">Total Product</th>
                                            <th class="text-center">Shipping Address</th>
                                            <th class="text-center">Delivery Status</th>
                                            <th class="text-center">Payment Method</th>
                                            <th class="text-center">Payment Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $key=>$order)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($orders->currentPage() - 1)*$orders->perPage()}}</td>
                                                <td class="text-center">{{$order->order_id}}</td>
                                                @php
                                                    $customer_details = json_decode($order->shipping_address);
                                                    $customer = App\Models\Customer::where('id',$customer_details->user_id)->first();
                                                @endphp
                                                <td class="text-left">
                                                    <b>Name: </b>{{$customer_details->name}} <br>
                                                    <b>Phone: </b>{{$customer->phone}} <br>
                                                    <b>Email: </b>{{$customer->email}}
                                                </td>
                                                <td class="text-center">{{$order->grand_total}}</td>
                                                <td class="text-center">{{$order->order_details_count}}</td>
                                                <td class="text-left">
                                                    <b>Country: </b>{{$customer_details->country}} <br>
                                                    <b>State: </b>{{$customer_details->state->state}} <br>
                                                    <b>City: </b>{{$customer_details->city->city}} <br>
                                                    <b>Pincode: </b>{{$customer_details->pincode}} <br>
                                                    <b>Pincode: </b>{{$customer_details->address}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge
                                                        @if($order->order_status == 'pending')
                                                            bg-warning
                                                        @elseif($order->order_status == 'confirm')
                                                            bg-orange
                                                        @elseif($order->order_status == 'on_delivery')
                                                            bg-purple
                                                        @elseif($order->order_status == 'delivered')
                                                            bg-success
                                                        @elseif($order->order_status == 'cancel')
                                                            bg-danger
                                                        @elseif($order->order_status == 'returned')
                                                            bg-danger
                                                        @endif
                                                    ">
                                                        {{ucwords(str_replace('_',' ',$order->order_status))}}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    @if($order->payment_type == 'cod')
                                                        Cash On Delivery
                                                    @else
                                                        Razorpay
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($order->payment_status == 'pending')
                                                        <span class="badge bg-danger">Unpaid</span>
                                                    @else
                                                        <span class="badge bg-success">Paid</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.order.detail',$order->order_id)}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
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
                                    {!! $orders->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
