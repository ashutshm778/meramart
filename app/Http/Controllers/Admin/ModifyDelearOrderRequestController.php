<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DealerOrderRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\ModifyDelearOrderRequest;

class ModifyDelearOrderRequestController extends Controller
{

    public function modifyDealerOrder(Request $request){
        $modify_order_request = ModifyDelearOrderRequest::orderBy('id','desc')->first();
        if($modify_order_request){
            $modify_order_id = $modify_order_request->modify_order_request_id + 1;
        }else{
            $modify_order_id = 1;
        }

        foreach($request->product_id as $key=>$product_id){

            $dealer_order_request = DealerOrderRequest::where('order_request_id',$request->order_request_id)->where('product_id',$product_id)->first();
            $dealer_order_request->product_price = $request->product_price[$key];

            if($dealer_order_request->product_discount_type == 'percent'){
                if($request->product_price[$key] == 0){
                    $product_discount = 0;
                }else{
                    $product_discount = ($request->discount_amount[$key]/$request->product_price[$key]) * 100;
                }
            }else{
                $product_discount = $request->discount_amount[$key];
            }
            $dealer_order_request->product_discount = $product_discount;
            $dealer_order_request->product_discount_amount = ($request->product_price[$key] - $request->discount_amount[$key]);
            $dealer_order_request->product_quantity = $request->quantity[$key];
            $dealer_order_request->save();

            $modify_dealer_order_request = new ModifyDelearOrderRequest;
            $modify_dealer_order_request->order_request_id = $request->order_request_id;
            $modify_dealer_order_request->modify_order_request_id = $modify_order_id;
            $modify_dealer_order_request->product_id = $product_id;
            $modify_dealer_order_request->product_price = $request->product_price[$key];
            $modify_dealer_order_request->product_discount = $request->discount_amount[$key];
            $modify_dealer_order_request->product_discount_amount = ($request->product_price[$key] - $request->discount_amount[$key]) * $request->quantity[$key];
            $modify_dealer_order_request->product_quantity = $request->quantity[$key];
            $modify_dealer_order_request->save();
        }

        return back()->with('success','Order Modify Successfully!');
    }

}
