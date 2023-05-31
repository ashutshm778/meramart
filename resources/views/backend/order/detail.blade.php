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
                                    <div class="col-sm-6 invoice-col">
                                        <address>
                                            <h4>Order Detail</h4>
                                            <b>ID:</b> {{$order->order_id}}<br>
                                            <b>Date:</b> {{$order->created_at->format('d-M-Y h:i A')}}<br>
                                            <b>Status:</b>
                                            @if($order->order_status != 'delivered' && $order->order_status != 'cancel' && $order->order_status != 'returned')
                                                <select id="order_status" class="form-control" style="width: 35%;" onchange="changeOrderStatus('{{$order->order_status}}')">
                                                    <option value="pending" @if($order->order_status == 'pending') selected @endif>Pending</option>
                                                    <option value="confirm" @if($order->order_status == 'confirm') selected @endif>Confirm</option>
                                                    <option value="on_delivery" @if($order->order_status == 'on_delivery') selected @endif>On Delivery</option>
                                                    <option value="delivered" @if($order->order_status == 'delivered') selected @endif>Delivered</option>
                                                    <option value="cancel" @if($order->order_status == 'cancel') selected @endif>Cancel</option>
                                                    <option value="returned" @if($order->order_status == 'returned') selected @endif>Returned</option>
                                                </select>
                                            @else
                                                <span class="badge bg-danger">{{ucwords($order->order_status)}}</span>
                                            @endif
                                        </address>
                                    </div>
                                    <div class="col-sm-6 invoice-col d-flex justify-content-end">
                                        <address>
                                            <h4>Customer Detail</h4>
                                            <b>Name:</b> {{$order->customer->first_name}} {{$order->customer->last_name}}<br>
                                            <b>Phone:</b> {{$order->customer->phone}}<br>
                                            <b>Email:</b> {{$order->customer->email}}<br>
                                            <b>Shipping Address:</b> {{json_decode($order->shipping_address)->address}} - {{json_decode($order->shipping_address)->pincode}} <br> {{json_decode($order->shipping_address)->city->city}} , {{json_decode($order->shipping_address)->state->state}} , {{json_decode($order->shipping_address)->country}}<br>
                                        </address>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="all_select"></th>
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
                                                @foreach ($order->order_details as $key=>$order_detail)
                                                    <tr>
                                                        <td>
                                                            @if($order->order_status != 'delivered' && $order->order_status != 'cancel' && $order->order_status != 'returned')
                                                                @if($order_detail->order_status != 'delivered' && $order_detail->order_status != 'cancel' && $order_detail->order_status != 'returned')
                                                                    <input type="checkbox" class="single_select" name="product_ids[]" value="{{$order_detail->product->id}}">
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$order_detail->product->name}}</td>
                                                        <td>₹ {{$order_detail->mrp_price}}</td>
                                                        <td>₹ {{$order_detail->discounted_price}}</td>
                                                        <td>{{$order_detail->price}}</td>
                                                        <td>{{$order_detail->quantity}}</td>
                                                        <td class="d-flex justify-content-end">₹ {{$order_detail->price * $order_detail->quantity}}</td>
                                                        <td class="text-center">
                                                            @if($order->order_status != 'delivered' && $order->order_status != 'cancel' && $order->order_status != 'returned')
                                                                @if($order_detail->order_status != 'delivered' && $order_detail->order_status != 'cancel' && $order_detail->order_status != 'returned')
                                                                    <select id="product_status_{{$order->id}}_{{$order_detail->product->id}}" class="form-control" onchange="changeProductStatus({{$order->id}},{{$order_detail->product->id}},'{{$order_detail->order_status}}')">
                                                                        <option value="pending" @if($order_detail->order_status == 'pending') selected @endif>Pending</option>
                                                                        <option value="confirm" @if($order_detail->order_status == 'confirm') selected @endif>Confirm</option>
                                                                        <option value="on_delivery" @if($order_detail->order_status == 'on_delivery') selected @endif>On Delivery</option>
                                                                        <option value="delivered" @if($order_detail->order_status == 'delivered') selected @endif>Delivered</option>
                                                                        <option value="cancel" @if($order_detail->order_status == 'cancel') selected @endif>Cancel</option>
                                                                        <option value="returned" @if($order_detail->order_status == 'returned') selected @endif>Returned</option>
                                                                    </select>
                                                                @else
                                                                    <span class="badge bg-danger">{{ucwords($order_detail->order_status)}}</span>
                                                                @endif
                                                            @else
                                                                <span class="badge bg-danger">{{ucwords($order_detail->order_status)}}</span>
                                                            @endif
                                                        </td>
                                                        @php
                                                            if($order_detail->order_status != 'cancel' && $order_detail->order_status != 'returned'){
                                                                $discount_amount = ($discount_amount + $order_detail->discounted_price) * $order_detail->quantity;
                                                                $total_final_amount = $total_final_amount + ($order_detail->price * $order_detail->quantity);
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

        function changeProductStatus(order_id,product_id,current_status){
            if (confirm('Are you want to Cancel this Product?')) {
                var status = $('#product_status_'+order_id+'_'+product_id).val();

                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.order.product.status')}}",
                    data:{
                        _token:'{{csrf_token()}}',
                        order_id:order_id,
                        product_id:product_id,
                        status:status
                    },
                    success: function(data) {
                        window.location.replace(data)
                    }
                });
            } else {
                $('#product_status_'+order_id+'_'+product_id).val(current_status);
            }
        }

        function changeOrderStatus(currect_order_stauts){
            if (confirm('Are you want to Cancel this Order?')) {
                var status = $('#order_status').val();
                var val = [];
                $('.single_select:checked').each(function(i){
                    val[i] = $(this).val();
                });

                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.order.product.status')}}",
                    data:{
                        _token:'{{csrf_token()}}',
                        order_id:"{{$order->id}}",
                        product_id:val,
                        status:status
                    },
                    success: function(data) {
                        window.location.replace(data)
                    }
                });
            } else {
                $('#order_status').val(currect_order_stauts);
            }
        }

        $('#all_select').change(function() {
            $('.single_select').prop('checked', this.checked);
        });
        $('.single_select').change(function() {
            if ($('.single_select:checked').length == $('.single_select').length) {
                $('#all_select').prop('checked', true);
            } else {
                $('#all_select').prop('checked', false);
            }
        });

    </script>

@endsection
