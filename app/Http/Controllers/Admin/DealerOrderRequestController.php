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

class DealerOrderRequestController extends Controller
{

    public function dealerOrderList(Request $request){
        $dealer_order_requests = DealerOrderRequest::with(['dealer','sales_member'])->orderBy('id','desc')->groupBy('order_request_id')->paginate(15);

        return view('backend.dealers.orders.index',compact('dealer_order_requests'),['page_title'=>'Dealer Order Request List']);
    }

    public function dealerOrderDetail($order_request_id){
        $dealer_order_request_details = DealerOrderRequest::where('order_request_id',$order_request_id)->with(['dealer','sales_member','product'])->get();

        $dealer_order = DealerOrder::where('order_request_id',$dealer_order_request_details[0]->order_request_id)->first();

        return view('backend.dealers.orders.detail',compact('dealer_order_request_details','dealer_order'));
    }

    public function confirmDealerOrder($order_id){

        $dealer_order_requests = DealerOrderRequest::where('order_request_id',$order_id)->get();
        DealerOrderRequest::where('order_request_id',$order_id)->update(['request_status'=>'confirm']);



        $dealer_order_id = DealerOrder::orderBy('id','desc')->first();
        if($dealer_order_id){
            $dealer_order_id = $dealer_order_id->order_id + 1;
        }else{
            $dealer_order_id = 1000001;
        }

        $dealer_order = new DealerOrder;
        $dealer_order->order_id = $order_id;
        $dealer_order->order_request_id = $dealer_order_requests[0]->order_request_id;
        $dealer_order->sales_member_id = $dealer_order_requests[0]->sales_member_id;
        $dealer_order->ordered_by = Auth::user()->id;
        $dealer_order->dealer_id = $dealer_order_requests[0]->dealer_id;
        $dealer_order->grand_total = 0.00;
        $dealer_order->total_discount = 0.00;
        $dealer_order->address = '';
        $dealer_order->order_status = 'confirm';
        $dealer_order->save();

        $grand_total = 0;
        $total_discount = 0;

        foreach($dealer_order_requests as $dealer_order_request){
            $dealer_order_detail = new DealerOrderDetail;
            $dealer_order_detail->order_id = $dealer_order->id;
            $dealer_order_detail->product_id = $dealer_order_request->product_id;
            $dealer_order_detail->product_price = $dealer_order_request->product_price;
            $dealer_order_detail->discount_price = $dealer_order_request->product_discount;
            $dealer_order_detail->final_price = $dealer_order_request->product_discount_amount;
            $dealer_order_detail->quantity = $dealer_order_request->product_quantity;
            $dealer_order_detail->product_order_status = 'confirm';
            $dealer_order_detail->save();

            $grand_total = $grand_total + $dealer_order_request->product_discount_amount * $dealer_order_request->product_quantity;
            $total_discount = $total_discount + $dealer_order_request->product_discount * $dealer_order_request->product_quantity;
        }

        DealerOrder::where('id',$dealer_order->id)->update([
            'grand_total'=>$grand_total,
            'total_discount'=>$total_discount
        ]);

        $month = Carbon::now()->format('F');
        $year = Carbon::now()->format('Y');

        $sales_assign_target = AssignTarget::where('sales_member_id',$dealer_order_requests[0]->sales_member_id)->where('month',$month)->where('year',$year)->first();
        if($sales_assign_target){
            $sales_assign_target->achive_target_amount = $sales_assign_target->achive_target_amount + $grand_total;
            $sales_assign_target->save();
        }

        $dealer_assign_target = AssignDealerTarget::where('dealer_id',$dealer_order_requests[0]->dealer_id)->where('month',$month)->where('year',$year)->first();
        if($dealer_assign_target){
            $dealer_assign_target->achive_target_amount = $dealer_assign_target->achive_target_amount + $grand_total;
            $dealer_assign_target->save();
        }

        return redirect()->route('admin.dealer.order.list')->with('success','Order Confirm Succesfully!');
    }

}
