<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index(Request $request){
        $orders = Order::withCount('order_details')->orderBy('id','desc')->paginate(10);

        return view('backend.order.index',compact('orders'),['page_title'=>'Order List']);
    }

    public function detail($order_id){
        $order = Order::where('order_id',$order_id)->with(['order_details','customer'])->first();

        return view('backend.order.detail',compact('order'),['page_title'=>'Order Details']);
    }

    public function productStatus(Request $request){

        if(!is_array($request->product_id)){
            $product_ids = explode(',',$request->product_id);
        }else{
            $product_ids = $request->product_id;
        }
        foreach ($product_ids as $product_id) {
            OrderDetail::where('order_id',$request->order_id)->where('product_id',$product_id)->update([
                'order_status'=>$request->status
            ]);
        }

        Order::where('id',$request->order_id)->update([
            'order_status'=>$request->status
        ]);
    }

}
