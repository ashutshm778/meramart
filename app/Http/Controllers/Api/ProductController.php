<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\DealerCart;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\OfferProduct;
use App\Http\Controllers\Controller;
use App\Models\Admin\SubSubCategory;

class ProductController extends Controller
{

    public function productList(Request $request)
    {
        $search_key = $request->search_key;
        $products=Product::select('id','name','category_id','thumbnail_image','mrp_price')->where('is_active',1);

        if($search_key){
            $products = $products->where('name','like','%'.$search_key.'%');
        }

        $products = $products->with('dealerCart:product_id,quantity')->simplePaginate(10);

        foreach($products as $product)
        {
            $product_price=getProductPrice($product->id,$request->type);
            $product->selling_price=$product_price['selling_price'];
            $product->discount_type=$product_price['discount_type'];
            $product->discount=$product_price['discount'];
            $product->product_price=$product_price['product_price'];
            $product->thumbnail_image=$product_price['thumbnail_image'];
            $product->category_id=$product_price['category_name'];
            $product->min_qty=$product_price['min_qty'];
        }

        return $products->appends(['search_key'=>$search_key]);
    }

    public function productDetail(Request $request)
    {
        $product=Product::where('is_active',1)->where('id',$request->product_id)->first();

        $product_price=getProductPrice($product->id,$request->type);
        $product->selling_price=$product_price['selling_price'];
        $product->discount_type=$product_price['discount_type'];
        $product->discount=$product_price['discount'];
        $product->product_price=$product_price['product_price'];
        $product->thumbnail_image=$product_price['thumbnail_image'];
        $product->gallery_image=$product_price['gallery_images'];
        $product->category_id=$product_price['category_name'];
        $product->subcategory_id=$product_price['subcategory_name'];
        $product->subsubcategory_id=$product_price['subsubcategory_name'];
        $product->brand_id=$product_price['brand'];
        $product->attribute=$product_price['attribute_name'];
        $product->min_qty=$product_price['min_qty'];
        $product->max_qty=$product_price['max_qty'];
        if(!$product->attribute_value)
        {
            $product->attribute_value=[];
        }

        $cart=DealerCart::where('sales_member_id',Auth::user()->id)->where('dealer_id',$request->dealer_id)->where('product_id',$product->id)->first();
        if($cart)
        {
            $product->in_cart=1;
            $product->cart_quantity=$cart->quantity;
        }
        else
        {
            $product->in_cart=0;
            $product->cart_quantity=0;
        }

        return $product->makeHidden([
            'added_by',
            'product_group_id',
            'slug',
            'purchase_price',
            'mrp_price',
            'retailer_selling_price',
            'retailer_discount_type',
            'retailer_discount',
            'distributor_selling_price',
            'distributor_discount_type',
            'distributor_discount',
            'wholeseller_selling_price',
            'wholeseller_discount_type',
            'wholeseller_discount',
            'retailer_min_qty',
            'retailer_max_qty',
            'distributor_min_qty',
            'wholeseller_min_qty',
            'tax_type',
            'tax_amount',
            'shipping_type',
            'shipping_amount',
            'tags',
            'video_link',
            'barcode_id',
            'retailer_point',
            'distributor_point',
            'wholeseller_point',
            'meta_title',
            'meta_key_word',
            'meta_description',
            'meta_image',
            'is_active',
            'is_feature',
            'is_trending',
            'is_bestseller',
            'is_new_arrival',
            'deleted_at',
            'created_at',
            'updated_at'
        ]);
    }

    public function customerProductList(Request $request)
    {
        $products = Product::select('id','name','thumbnail_image','retailer_selling_price','retailer_discount_type','retailer_discount')->where('is_active',1);

        if($request->type == 'category')
        {
            $products = $products->whereJsonContains('category_id',''.$request->category_id);
        }
        if($request->type == 'sub_category')
        {
            $products = $products->whereJsonContains('subcategory_id',''.$request->sub_category_id);
        }
        if($request->type == 'flash_deals')
        {
            $products_ids = OfferProduct::where('offer_id',$request->flash_deal_id)->pluck('product_id');
            $products = $products->whereIn('id',$products_ids->toArray());
        }
        if($request->type == 'new_arrivals')
        {
            $products = $products->where('is_new_arrival',1);
        }
        if($request->type == 'best_sellers')
        {
            $products = $products->where('is_bestseller',1);
        }
        if($request->type == 'trendings')
        {
            $products = $products->where('is_trending',1);
        }
        if($request->type == 'features')
        {
            $products = $products->where('is_feature',1);
        }
        $products = $products->simplepaginate(10);

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
