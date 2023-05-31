<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\DealerCart;
use Illuminate\Http\Request;
use App\Models\DealerOrderRequest;
use App\Http\Controllers\Controller;

class DealerOrderController extends Controller
{

    public function dealerOrderRequest(Request $request)
    {
        $dealer_carts=DealerCart::where('sales_member_id',Auth::user()->id)->where('dealer_id',$request->dealer_id)->get();
        if(count($dealer_carts))
        {
            $order_id=DealerOrderRequest::latest()->first();
            if($order_id)
            {
                $order_request_id=$order_id->order_request_id+1;
            }
            else
            {
                $order_request_id='10000';
            }
            foreach($dealer_carts as $dealer_cart)
            {
                $prices=getProductPrice($dealer_cart->product_id,$request->type);
                DealerOrderRequest::create([
                    'order_request_id'=>$order_request_id,
                    'sales_member_id'=>Auth::user()->id,
                    'dealer_id'=>$request->dealer_id,
                    'product_id'=>$dealer_cart->product_id,
                    'product_price'=>$prices['selling_price'],
                    'product_discount_type'=>$prices['discount_type'],
                    'product_discount'=>$prices['discount'],
                    'product_discount_amount'=>$prices['product_price'],
                    'product_quantity'=>$dealer_cart->quantity,
                    'request_status'=>'pending',
                ]);

                DealerCart::where('sales_member_id',Auth::user()->id)->where('dealer_id',$request->dealer_id)->where('product_id',$dealer_cart->product_id)->delete();
            }
            return response()->json(['msg'=>'Order Requested Succesfully!'],200);
        }
        else
        {
            return response()->json(['msg'=>'No Product In Your Cart!'],401);
        }



    }

}
