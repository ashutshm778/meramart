@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Dealer Order Detail</li>
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
                            <div class="invoice p-3 mb-3">
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <address>
                                            <h4>Order Detail</h4>
                                            <b>ID:</b> {{$order->order_id}}<br>
                                            <b>Date:</b> {{$order->created_at->format('d-M-Y')}}<br>
                                            <b>Status:</b>
                                            @if($order->order_status == 'confirm')
                                            <select id="order_status" class="form-control" onchange="changeOrderStatus('{{$order->order_status}}')">
                                                <option value="confirm" @if($order->order_status == 'confirm') selected @endif>Confirm</option>
                                                <option value="cancel" @if($order->order_status == 'cancel') selected @endif>Cancel</option>
                                                <option value="delivered" @if($order->order_status == 'delivered') selected @endif>Delivered</option>
                                            </select>
                                            @else
                                                <span class="badge bg-danger">{{ucwords($order->order_status)}}</span>
                                            @endif
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col d-flex justify-content-center">
                                        <address>
                                            <h4>Dealer Detail</h4>
                                            <b>Name:</b> {{$order->dealer->first_name}} {{$order->dealer->last_name}}<br>
                                            <b>Phone:</b> {{$order->dealer->phone}}<br>
                                            <b>Email:</b> {{$order->dealer->email}}<br>
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col d-flex justify-content-end">
                                        <address>
                                            <h4>Sales Member Detail</h4>
                                            <b>Name:</b> {{$order->sales_member->name}}<br>
                                            <b>Phone:</b> {{$order->sales_member->phone}}<br>
                                            <b>Email:</b> {{$order->sales_member->email}}<br>
                                        </address>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S.N</th>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Discount</th>
                                                    <th>Discounted Amount</th>
                                                    <th>Qty</th>
                                                    <th class="d-flex justify-content-end">Total Amount</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $discount_amount = 0;
                                                    $total_final_amount = 0;
                                                @endphp
                                                @foreach ($order->orderDetail as $key=>$order_detail)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$order_detail->product->name}}</td>
                                                        <td>₹ {{$order_detail->product_price}}</td>
                                                        <td>₹ {{$order_detail->discount_price}}</td>
                                                        <td>{{$order_detail->final_price}}</td>
                                                        <td>{{$order_detail->quantity}}</td>
                                                        <td class="d-flex justify-content-end">₹ {{$order_detail->final_price * $order_detail->quantity}}</td>
                                                        <td class="text-center">
                                                            @if($order->order_status == 'confirm')
                                                                @if($order_detail->product_order_status != 'cancel')
                                                                <select id="product_status_{{$order->id}}_{{$order_detail->product->id}}" class="form-control" onchange="changeProductStatus({{$order->id}},{{$order_detail->product->id}})">
                                                                    <option value="confirm" @if($order_detail->product_order_status == 'confirm') selected @endif>Confirm</option>
                                                                    <option value="cancel" @if($order_detail->product_order_status == 'cancel') selected @endif>Cancel</option>
                                                                </select>
                                                                @else
                                                                    <span class="badge bg-danger">Cancel</span>
                                                                @endif
                                                            @else

                                                                <span class="badge @if($order_detail->product_order_status == 'cancel') bg-danger @else bg-success @endif">{{ucwords($order_detail->product_order_status)}}</span>
                                                            @endif
                                                        </td>
                                                        @php
                                                            if($order_detail->product_order_status != 'cancel'){
                                                                $discount_amount = ($discount_amount + $order_detail->discount_price) * $order_detail->quantity;
                                                                $total_final_amount = $total_final_amount + ($order_detail->final_price * $order_detail->quantity);
                                                            }
                                                        @endphp
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9"></div>
                                    <div class="col-3 d-flex justify-content-end">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Discount Amount:</th>
                                                        <td class="d-flex justify-content-end">₹
                                                            {{$discount_amount}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Amount:</th>
                                                        <td class="d-flex justify-content-end">₹
                                                            {{$total_final_amount}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>

        function changeProductStatus(order_id,product_id){
            if (confirm('Are you want to Cancel this Product?')) {
                var status = $('#product_status_'+order_id+'_'+product_id).val();

                $.ajax({
                    type: 'GET',
                    url: "{{route('admin.dealer.final.order.product.status',['','',''])}}/"+order_id+'/'+product_id+'/'+status,
                    success: function(data) {
                        window.location.replace(data)
                    }
                });
            } else {
                $('#product_status_'+order_id+'_'+product_id).val('confirm');
            }
        }

        function changeOrderStatus(currect_order_stauts){
            if (confirm('Are you want to Cancel this Order?')) {
                var status = $('#order_status').val();
                $.ajax({
                    type: 'GET',
                    url: "{{route('admin.dealer.final.order.status',['',''])}}/{{$order->id}}"+'/'+status,
                    success: function(data) {
                        window.location.replace(data)
                    }
                });
            } else {
                $('#order_status').val(currect_order_stauts);
            }
        }

    </script>

@endsection
