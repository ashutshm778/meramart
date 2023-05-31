<?php

namespace App\Http\Controllers\Admin;

use App\CPU\CouponManager;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{

    public function index(Request $request)
    {
        $coupons = CouponManager::withoutTrash()->paginate(10);

        return view('backend.coupon.index',compact('coupons'),['page_title'=>'Coupon List']);
    }

    public function create()
    {
        return view('backend.coupon.create',['page_title'=>'Add Coupon']);
    }

    public function store(Request $request)
    {
        $coupon = new Coupon;
        $coupon->type = $request->type;
        $coupon->code = $request->code;
        $coupon->image = $request->image;
        $coupon->description = $request->description;
        $coupon->product_ids = $request->product_ids;
        $coupon->minimum_order_value = $request->minimum_order_value;
        $coupon->maximum_discount_amount = $request->maximum_discount_amount;
        $coupon->discount = $request->discount;
        $coupon->discount_type = $request->discount_type;
        $coupon->start_date = strtotime(explode('-',$request->date_range)[0]);
        $coupon->end_date = strtotime(explode('-',$request->date_range)[1]);
        $coupon->number_of_usages = $request->number_of_usages;
        $coupon->save();
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);

        return view('backend.coupon.edit',compact('coupon'),['page_title'=>'Edit Coupon']);
    }

    public function update(Request $request,$id)
    {
        $coupon = Coupon::find($id);
        $coupon->type = $request->type;
        $coupon->code = $request->code;
        $coupon->image = $request->image;
        $coupon->description = $request->description;
        $coupon->product_ids = $request->product_ids;
        $coupon->minimum_order_value = $request->minimum_order_value;
        $coupon->maximum_discount_amount = $request->maximum_discount_amount;
        $coupon->discount = $request->discount;
        $coupon->discount_type = $request->discount_type;
        $coupon->start_date = strtotime(explode('-',$request->date_range)[0]);
        $coupon->end_date = strtotime(explode('-',$request->date_range)[1]);
        $coupon->number_of_usages = $request->number_of_usages;
        $coupon->save();
    }

    public function status($id,$status)
    {
        Coupon::where('id',$id)->update(['is_active'=>$status]);

        return back()->with('success','Coupon Deactived Successfully!');
    }

    public function destroy($id)
    {
        Coupon::where('id',$id)->update(['is_delete'=>1]);

        return back()->with('error','Coupon Deleted Successfully!');
    }

    public function getCouponProductTable(Request $request)
    {
        $products=$request->products;
        $product_arr=[];
        foreach(json_decode($products) as $product)
        {
            if($product->value)
            {
                $product_arr[] = $product->property_id;
            }
        }
        $offer_id=$request->offer_id;

        $offer_products = Product::where('is_active',1)->whereIn('id',$product_arr)->get();
        return view('backend.coupon.product_table',compact('offer_products','offer_id'));
    }

}
