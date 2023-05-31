<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\DealerCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealerCartController extends Controller
{

    public function addUpdateDealerCart(Request $request)
    {
        DealerCart::updateOrCreate([
            'sales_member_id'=>Auth::user()->id,
            'dealer_id'=>$request->dealer_id,
            'product_id'=>$request->product_id
        ],
        [
            'quantity'=>$request->quantity
        ]);

        return response()->json(['msg'=>'Product Succesfully Added To Cart!'],200);
    }

    public function cartDealerList(Request $request)
    {
        return $list=DealerCart::where('sales_member_id',Auth::user()->id)->with('dealer.businessDetail')->groupBy('dealer_id')->simplepaginate(10);
    }

    public function cartDealerProductList(Request $request)
    {
        $list=DealerCart::where('sales_member_id',Auth::user()->id)->where('dealer_id',$request->dealer_id)->with(['product' => function ($query) {
            $query->select('id','name','category_id','thumbnail_image') ;
        }])->simplepaginate(10);

        foreach($list as $product)
        {
            $product_price=getProductPrice($product->product->id,$request->type);
            $product->product->selling_price=$product_price['selling_price'];
            $product->product->discount_type=$product_price['discount_type'];
            $product->product->discount=$product_price['discount'];
            $product->product->product_price=$product_price['product_price'];
            $product->product->thumbnail_image=$product_price['thumbnail_image'];
            $product->product   ->category_id=$product_price['category_name'];
        }

        return $list;
    }

    public function deleteCartProduct(Request $request){
        DealerCart::where('sales_member_id',Auth::user()->id)->where('dealer_id',$request->dealer_id)->where('product_id',$request->product_id)->delete();

        return response()->json(['msg'=>'Product Deleted From Cart Successfully!'],200);
    }

}
