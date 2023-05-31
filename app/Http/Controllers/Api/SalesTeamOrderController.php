<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\DealerOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DealerOrderResource;
use App\Http\Resources\Api\DealerOrderDetailResource;

class SalesTeamOrderController extends Controller
{

    public function salesTeamOrderList(){
        $orders = DealerOrder::where('sales_member_id',Auth::user()->id)->with(['dealer'])->orderBy('id','desc')->simplePaginate(15);

        return DealerOrderResource::collection($orders);
    }

    public function orderDetail($order_id){
        $order_detail = DealerOrder::select('id','order_id','grand_total','total_discount','address','order_status','created_at')->where('order_id',$order_id)->with('orderDetail.product')->first();

        return response()-> json(new DealerOrderDetailResource($order_detail));
    }

}
