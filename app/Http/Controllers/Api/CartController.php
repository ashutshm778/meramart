<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function customerAddUpdateCart(Request $request)
    {
        Cart::updateOrCreate([
            'user_id'=>Auth::user()->id,
            'product_id'=>$request->product_id
        ],
        [
            'quantity'=>$request->qty
        ]);

        return response()->json([
            'msg'=>'Product Added Successfully!'
        ]);
    }

    public function customerCartDelete(Request $request)
    {
        Cart::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->delete();

        return response()->json([
            'msg'=>'Product Deleted Successfully!'
        ]);
    }

    public function customerCartList(Request $request)
    {
        $carts = Cart::where('user_id',Auth::user()->id)->pluck('product_id');

        $products = Product::select('id','name','thumbnail_image','retailer_selling_price','retailer_discount_type','retailer_discount')->whereIn('id',$carts->toArray())->get();
        foreach($products as $product)
        {
            $product->thumbnail_image = asset('public/'.api_asset($product->thumbnail_image));
            if($product->retailer_discount_type == 'percent')
            {
                $amount = ($product->retailer_selling_price*$product->retailer_discount)/100;
            }
            else
            {
                $amount = $product->retailer_discount;
            }
            $product->price = $product->retailer_selling_price;
            $product->discount_amount = $amount;
            $product->discounted_amount = $product->retailer_selling_price - $amount;
            $product->quantity = Cart::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first()->quantity;
        }
        return response()->json([
            'cart_list'=>$products
        ]);
    }

}
