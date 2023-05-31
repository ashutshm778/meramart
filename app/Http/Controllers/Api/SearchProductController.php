<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class SearchProductController extends Controller
{

    public function customerProductSearch(Request $request)
    {
        $category_id = Category::where('is_active',1)->where('name','like','%'.$request->name.'%')->first();

        $products = Product::select('id','name','thumbnail_image','retailer_selling_price','retailer_discount_type','retailer_discount')->where('is_active',1)->whereJsonContains('category_id',''.optional($category_id)->id)->orWhere('name','like','%'.$request->name.'%')->simplepaginate(10);

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
        }

        return $products;
    }

}
