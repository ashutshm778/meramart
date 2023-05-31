<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\CustomerAddress;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    function customerStoreOrder(Request $request)
    {
        $user_id = Auth::user()->id;
        $order_id = Order::latest()->first();
        if($order_id)
        {
            $order_id = $order_id->order_id + 1;
        }
        else
        {
            $order_id = 10001;
        }

        $mrp_prices = 0;
        $selling_prices = 0;
        $discounted_prices = 0;

        $order = new Order;

        $order->order_id = $order_id;
        $order->user_id = $user_id;
        $order->grand_total= $discounted_prices;
        $order->total_product_discount= $selling_prices - $discounted_prices;
        $order->coupon_discount= 0.00;
        $order->wallet_discount= 0.00;
        $order->shipping_address= CustomerAddress::where('id',$request->shipping_address_id)->with(['state','city'])->first();
        $order->payment_type= $request->payment_type;
        $order->payment_details= '';
        $order->payment_status= 'pending';
        $order->remark= '';

        $carts = Cart::where('user_id',$user_id)->get();


        if($order->save())
        {
            foreach($carts as $cart)
            {
                $product = Product::where('id',$cart->product_id)->first();
                if($product)
                {
                    $mrp_prices = $mrp_prices + $product->mrp_price;
                    $selling_prices = $selling_prices + $product->retailer_selling_price * $cart->quantity;

                    if($product->retailer_discount_type == 'percent')
                    {
                        $discount_amount = ($product->retailer_selling_price * $product->retailer_discount)/100;
                        $discounted_prices = $discounted_prices + ($product->retailer_selling_price  * $cart->quantity) - $discount_amount;
                    }
                    elseif($product->retailer_discount_type == 'amount')
                    {
                        $discount_amount = $product->retailer_discount;
                        $discounted_prices = $discounted_prices + ($product->retailer_selling_price  * $cart->quantity) - $discount_amount;
                    }
                    $order_details = new OrderDetail;

                    $order_details->order_id = $order->id;
                    $order_details->product_id = $cart->product_id;
                    $order_details->quantity = $cart->quantity;
                    $order_details->mrp_price = $product->retailer_selling_price;
                    $order_details->price = $product->retailer_selling_price - $discount_amount;
                    $order_details->discounted_price = $discount_amount;
                    $order_details->tax = $product->tax_amount;
                    $order_details->shipping_cost = 0.00;

                    $order_details->save();

                    Cart::destroy($cart->id);
                }
            }

            Order::where('id',$order->id)->update([
                'grand_total'=>$discounted_prices,
                'total_product_discount'=>$selling_prices - $discounted_prices
            ]);
        }

        $order_list = Order::where('id',$order->id)->with('order_details.product:id,name,thumbnail_image,retailer_selling_price,retailer_discount_type,retailer_discount')->first();

        foreach($order_list->order_details as $product)
        {
            $product->product->thumbnail_image = asset('public/'.api_asset($product->product->thumbnail_image));
            if($product->product->retailer_discount_type == 'percent')
            {
                $amount = ($product->product->retailer_selling_price*$product->product->retailer_discount)/100;
            }
            else
            {
                $amount = $product->product->retailer_discount;
            }
            $product->product->price = $product->product->retailer_selling_price;
            $product->product->discount_amount = $amount;
            $product->product->discounted_amount = $product->product->retailer_selling_price - $amount;
        }

        return $order_list;
    }

    public function customerOrderList(Request $request)
    {
        $orders = Order::select('id','order_id','grand_total','created_at')->where('user_id',Auth::user()->id)->get();

        foreach($orders as $order)
        {
            $order->order_date = $order->created_at->format('d-M-Y h:i A');
            $order->order_status = 'Pending';
            $order->product_count = OrderDetail::where('order_id',$order->id)->count();

        }
        return response()->json([
            'orders'=>$orders->makeHidden('created_at')
        ]);
    }

    public function customerOrderDetail(Request $request)
    {
        $orders = Order::where('order_id',$request->order_id)->with(['order_details:order_id,product_id,quantity,mrp_price,price,discounted_price,tax','order_details.product:id,name,thumbnail_image'])->first();

        foreach($orders->order_details as $order_detail)
        {
            $order_detail->product->thumbnail_image = asset('public/'.api_asset($order_detail->product->thumbnail_image));;
        }

        $orders->shipping_address = json_decode($orders->shipping_address);

        return $orders->makeHidden(['id','user_id','staff_id','']);
    }

}
