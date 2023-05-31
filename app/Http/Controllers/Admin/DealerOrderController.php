<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use App\Models\DealerOrder;
use Illuminate\Http\Request;
use App\Models\DealerOrderDetail;
use App\Models\Admin\AssignTarget;
use App\Models\DealerOrderRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\AssignDealerTarget;

class DealerOrderController extends Controller
{

    public function dealerFinalOrderList(){
        $dealer_orders = DealerOrder::with(['dealer'])->withCount('orderDetail')->orderBy('id','desc')->paginate(15);

        return view('backend.dealers.final_order.index',compact('dealer_orders'),['page_title'=>'Dealer Order List']);
    }

    public function dealerFinalOrderDetail($order_id){
        $order = DealerOrder::where('order_id',$order_id)->with(['dealer','sales_member','orderDetail.product'])->first();

        return view('backend.dealers.final_order.detail',compact('order'));
    }

    public function dealerFinalOrderProductStatus($order_id,$product_id,$status){
        DealerOrderDetail::where('order_id',$order_id)->where('product_id',$product_id)->update([
            'product_order_status'=>$status
        ]);

        $order = DealerOrder::find($order_id);

        return route('admin.dealer.final.order.detail',$order->order_id);
    }

    public function dealerFinalOrderStatus($order_id,$status){
        $order = DealerOrder::find($order_id);
        $order->order_status = $status;
        $order->save();
        return route('admin.dealer.final.order.list');
    }

}
