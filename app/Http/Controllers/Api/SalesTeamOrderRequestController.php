<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Models\DealerOrderRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\ModifyDelearOrderRequest;
use App\Http\Resources\Api\ModifyDealerOrderResource;
use App\Http\Resources\Api\DealerOrderRequestResource;

class SalesTeamOrderRequestController extends Controller
{

    public function salesTeamOrderRequestList(){
        $order_requests = DealerOrderRequest::where('sales_member_id',Auth::user()->id)->with(['dealer'])->orderBy('id','desc')->groupBy('order_request_id')->simplePaginate(10);

        return DealerOrderRequestResource::collection($order_requests);
    }

    public function salesTeamOrderRequestDetail($order_request_id){


        $order_requests = DealerOrderRequest::select('order_request_id','dealer_id','request_status')->where('sales_member_id',Auth::user()->id)->where('order_request_id',$order_request_id)->with('dealer')->first();

        $order_requests->products = DealerOrderRequest::select('product_id','product_price','product_discount_type','product_discount','product_discount_amount','product_quantity')->where('sales_member_id',Auth::user()->id)->where('order_request_id',$order_request_id)->with('product:id,name')->get();

        $modify_delear_order_requests = ModifyDelearOrderRequest::select('modify_order_request_id','created_at')->where('order_request_id',$order_request_id)->groupBy('modify_order_request_id')->orderBy('modify_order_request_id','desc')->get();

        foreach($modify_delear_order_requests as $modify_delear_order_request){
            $modify_delear_order_request->date = $modify_delear_order_request->created_at->format('d-m-Y h:i A');
            $modify_delear_order_request->product = ModifyDelearOrderRequest::select('product_id','product_price','product_discount','product_discount_amount','product_quantity')->where('order_request_id',$order_request_id)->where('modify_order_request_id',$modify_delear_order_request->modify_order_request_id)->with('product:id,name')->get();
        }

        return response()->json(['current_order_request'=>$order_requests,'modify_order_request_list'=>$modify_delear_order_requests]);

    }

}
