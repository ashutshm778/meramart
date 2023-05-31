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
                    @if(!$dealer_order)
                        <div class="col-sm-3 d-flex justify-content-end">
                            <a class="btn btn-primary" onclick="modifyOrderRequest()">Modify Order Request</a>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-end">
                            <a class="btn btn-primary" href="{{route('admin.confirm.dealer.order',$dealer_order_request_details[0]->order_request_id)}}">Confirm Order Request</a>
                        </div>
                    @endif
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
                                            <b>ID:</b> {{$dealer_order_request_details[0]->order_request_id}}<br>
                                            <b>Date:</b> {{$dealer_order_request_details[0]->created_at->format('d-M-Y')}}<br>
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col d-flex justify-content-center">
                                        <address>
                                            <h4>Dealer Detail</h4>
                                            <b>Name:</b> {{$dealer_order_request_details[0]->dealer->first_name}} {{$dealer_order_request_details[0]->dealer->last_name}}<br>
                                            <b>Phone:</b> {{$dealer_order_request_details[0]->dealer->phone}}<br>
                                            <b>Email:</b> {{$dealer_order_request_details[0]->dealer->email}}<br>
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col d-flex justify-content-end">
                                        <address>
                                            <h4>Sales Member Detail</h4>
                                            <b>Name:</b> {{$dealer_order_request_details[0]->sales_member->name}}<br>
                                            <b>Phone:</b> {{$dealer_order_request_details[0]->sales_member->phone}}<br>
                                            <b>Email:</b> {{$dealer_order_request_details[0]->sales_member->email}}<br>
                                        </address>
                                    </div>
                                </div>
                                <hr>
                                <center><h1>Final Order Request</h1></center>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $discount_amount = 0;
                                                    $total_final_amount = 0;
                                                @endphp
                                                @foreach ($dealer_order_request_details as $key=>$dealer_order_request_detail)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$dealer_order_request_detail->product->name}}</td>
                                                        <td>₹ {{$dealer_order_request_detail->product_price}}</td>
                                                        <td>
                                                            @if($dealer_order_request_detail->product_discount_type == 'percent')
                                                                {{$dealer_order_request_detail->product_discount}} %
                                                            @else
                                                                ₹ {{$dealer_order_request_detail->product_discount}}
                                                            @endif
                                                        </td>
                                                        <td>{{$dealer_order_request_detail->product_discount_amount}}</td>
                                                        <td>{{$dealer_order_request_detail->product_quantity}}</td>
                                                        <td class="d-flex justify-content-end">₹ {{$dealer_order_request_detail->product_discount_amount * $dealer_order_request_detail->product_quantity}}</td>
                                                        @php
                                                            $discount_amount = $discount_amount + ($dealer_order_request_detail->product_price - $dealer_order_request_detail->product_discount_amount) * $dealer_order_request_detail->product_quantity;
                                                            $total_final_amount = $total_final_amount + ($dealer_order_request_detail->product_discount_amount * $dealer_order_request_detail->product_quantity);
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

                                @php
                                    $modify_orders = App\Models\Admin\ModifyDelearOrderRequest::where('order_request_id',$dealer_order_request_details[0]->order_request_id)->groupBy('modify_order_request_id')->orderBy('modify_order_request_id','desc')->get();
                                @endphp
                                @foreach($modify_orders as $modify_order)
                                    @php
                                        $modify_order_details = App\Models\Admin\ModifyDelearOrderRequest::where('order_request_id',$dealer_order_request_details[0]->order_request_id)->where('modify_order_request_id',$modify_order->modify_order_request_id)->get();
                                    @endphp
                                    <hr>
                                    <center><h1>{{$modify_order->created_at->format('d-M-Y h:i A')}}</h1></center>
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $discount_amount = 0;
                                                        $total_final_amount = 0;
                                                    @endphp
                                                    @foreach ($modify_order_details as $mod_key=>$modify_order_detail)
                                                        <tr>
                                                            <td>{{$mod_key+1}}</td>
                                                            <td>{{$modify_order_detail->product->name}}</td>
                                                            <td>₹ {{$modify_order_detail->product_price}}</td>
                                                            <td>₹ {{$modify_order_detail->product_discount}}</td>
                                                            <td>₹ {{$modify_order_detail->product_price - $modify_order_detail->product_discount}}</td>
                                                            <td>{{$modify_order_detail->product_quantity}}</td>
                                                            <td class="d-flex justify-content-end">₹ {{$modify_order_detail->product_discount_amount}}</td>
                                                            @php
                                                                $discount_amount = $discount_amount + ($modify_order_detail->product_discount * $modify_order_detail->product_quantity);
                                                                $total_final_amount = $total_final_amount + $modify_order_detail->product_discount_amount;
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="con-close-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="display:inline;padding:5px">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h1>Modify Order Request</h1></center>
                </div>
                <form action="{{route('admin.modify.dealer.order')}}" method="POST">
                    @csrf
                    <input type="hidden" name="order_request_id" value="{{$dealer_order_request_details[0]->order_request_id}}">
                    <div class="modal-body p-2" id="modal_body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Discount</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($dealer_order_request_details as $model_key=>$model_dealer_order_request_details)
                                        <input type="hidden" name="product_id[]" value="{{$model_dealer_order_request_details->product_id}}">
                                        <tr>
                                            <td class="text-center">{{$model_key+1}}</td>
                                            <td class="text-center">{{$model_dealer_order_request_details->product->name}}</td>
                                            <td class="text-center">
                                                <input type="number" name="product_price[]" id="product_price_{{$model_dealer_order_request_details->product_id}}" class="form-control" value="{{$model_dealer_order_request_details->product_price}}" onkeyup="calculatePrice({{$model_dealer_order_request_details->product_id}})" readonly>
                                            </td>
                                            <td class="text-center">
                                                <input type="number" name="discount_amount[]" id="discount_amount_{{$model_dealer_order_request_details->product_id}}" class="form-control" value="{{$model_dealer_order_request_details->product_price - $model_dealer_order_request_details->product_discount_amount}}" onkeyup="calculatePrice({{$model_dealer_order_request_details->product_id}})">
                                            </td>
                                            <td class="text-center">
                                                <input type="number" name="quantity[]" id="quantity_{{$model_dealer_order_request_details->product_id}}" class="form-control" value="{{$model_dealer_order_request_details->product_quantity}}" onkeyup="calculatePrice({{$model_dealer_order_request_details->product_id}})">
                                            </td>
                                            <td class="text-center" id="total_amount_{{$model_dealer_order_request_details->product_id}}">
                                                {{$model_dealer_order_request_details->product_discount_amount * $model_dealer_order_request_details->product_quantity}}
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-9"></div>
                            <div class="col-3 d-flex justify-content-end">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Discount Amount:</th>
                                                <td class="d-flex justify-content-end" id="model_discount_amount">₹
                                                    {{$discount_amount}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total Amount:</th>
                                                <td class="d-flex justify-content-end" id="model_final_amount">₹
                                                    {{$total_final_amount}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Modify</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        function modifyOrderRequest(){
            $('#con-close-modal').modal('show')
        }

        function calculatePrice(product_id){
            var product_price = $('#product_price_'+product_id).val();
            var discount_amount = $('#discount_amount_'+product_id).val();
            var quantity = $('#quantity_'+product_id).val();

            var total_amount = (parseInt(product_price) - parseInt(discount_amount)) * parseInt(quantity)
            $('#total_amount_'+product_id).text(total_amount)

            var total_discount = 0;
            var final_amount = 0;
            @foreach ($dealer_order_request_details as $asd)
                var pro = "{{$asd->product_id}}";
                total_discount = parseInt(total_discount) + parseInt($('#discount_amount_'+pro).val()) * parseInt($('#quantity_'+pro).val());
                final_amount = parseInt(final_amount) + (parseInt($('#product_price_'+pro).val()) - parseInt($('#discount_amount_'+pro).val())) * parseInt($('#quantity_'+pro).val())
            @endforeach

            $('#model_discount_amount').text(total_discount)
            $('#model_final_amount').text(final_amount)
        }

    </script>

@endsection
