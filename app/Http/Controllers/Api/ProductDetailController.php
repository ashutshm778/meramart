<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Admin\Brnad;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductDetailController extends Controller
{

    public function customerProductDetail(Request $request)
    {
        $product = Product::select('category_id','subcategory_id','brand_id','name','description','thumbnail_image','gallery_image','unit','hsn_code','sku','retailer_discount_type','retailer_selling_price','retailer_discount')->where('id',$request->product_id)->first();

        $product->thumbnail_image = asset('public/'.api_asset($product->thumbnail_image));

        foreach(explode(',',$product->gallery_image) as $gallery_image)
        {
            $gallery_images[]=asset('public/'.api_asset($gallery_image));
        }

        foreach($product->category_id as $category)
        {
            $category_name[]=Category::where('id',$category)->first()->name;
        }

        foreach($product->subcategory_id as $subcategory)
        {
            $subcategory_name[]=SubCategory::where('id',$subcategory)->first()->name;
        }

        $product->gallery_image = $gallery_images;
        $product->category_id = $category_name;
        $product->subcategory_id = $subcategory_name;
        $product->brand_id = Brnad::where('id',$product->brand_id)->first()->name;

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

        $cart = Cart::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->first();

        if($cart)
        {
            $product->is_cart = 1;
            $product->cart_qty = $cart->quantity;
        }
        else
        {
            $product->is_cart = 0;
            $product->cart_qty = 0;
        }
        $related_products = Product::select('id','name','thumbnail_image','retailer_selling_price','retailer_discount_type','retailer_discount')->where('is_active',1)->where('brand_id',Brnad::where('name',$product->brand_id)->first()->id)->take(10)->get();
        foreach($related_products as $related_product)
        {
            $related_product->thumbnail_image = asset('public/'.api_asset($related_product->thumbnail_image));
            if($related_product->retailer_discount_type == 'percent')
            {
                $amount = ($related_product->retailer_selling_price*$related_product->retailer_discount)/100;
            }
            else
            {
                $amount = $related_product->retailer_discount;
            }
            $related_product->price = $related_product->retailer_selling_price;
            $related_product->discount_amount = $amount;
            $related_product->discounted_amount = $related_product->retailer_selling_price - $amount;
        }
        return response()->json([
            'product'=>$product->makeHidden(['retailer_discount_type','retailer_selling_price','retailer_discount']),
            'related_products'=>$related_products
        ]);

    }

}
