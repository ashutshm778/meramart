<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Admin\Brnad;
use App\Models\Admin\Offer;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\AppSetting;
use App\Models\Admin\SubCategory;
use App\Models\Admin\AssignDealer;
use App\Models\Admin\OfferProduct;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function businessPersonHome(Request $request)
    {
        $category_list=Category::select('slug','name','icon')->where('is_feature',1)->get();

        foreach($category_list as $category_data)
        {
            $category_data->icon=asset('public/'.api_asset($category_data->icon));
        }

        $feature_product_list=Product::select('product_group_id','name','category_id','thumbnail_image')->where('is_feature',1)->groupBy('product_group_id')->take(10)->get();
        $feature_product_list=$this->processProductData($feature_product_list);

        $best_selling_product_list=Product::select('product_group_id','name','category_id','thumbnail_image')->where('is_bestseller',1)->groupBy('product_group_id')->take(10)->get();
        $best_selling_product_list=$this->processProductData($best_selling_product_list);

        $trending_product_list=Product::select('product_group_id','name','category_id','thumbnail_image')->where('is_trending',1)->groupBy('product_group_id')->take(10)->get();
        $trending_product_list=$this->processProductData($trending_product_list);

        $new_arrival_product_list=Product::select('product_group_id','name','category_id','thumbnail_image')->where('is_new_arrival',1)->groupBy('product_group_id')->take(10)->get();
        $new_arrival_product_list=$this->processProductData($new_arrival_product_list);

        return response()->json(['category_list'=>$category_list,'feature_product_list'=>$feature_product_list,'best_selling_product_list'=>$best_selling_product_list,'trending_product_list'=>$trending_product_list,'new_arrival_product_list'=>$new_arrival_product_list]);
    }

    public function processProductData($product_list)
    {
        foreach($product_list as $product_data)
        {
            foreach($product_data->category_id as $category)
            {
                $category_detail[]=Category::select('name')->where('id',$category)->first()->name;
            }
            $product_data->category_id=$category_detail;
            $product_data->thumbnail_image=asset('public/'.api_asset($product_data->thumbnail_image));

            $prices=getPriceRange($product_data->product_group_id);
            $user_type=Auth::user()->type;

            if($user_type == 'distributor')
            {
                if($prices['distributor_min_price'] != $prices['distributor_max_price'])
                {
                    $price='₹'.$prices['distributor_min_price'].' - ₹'. $prices['distributor_max_price'];
                }
                else
                {
                    $price='₹'.$prices['distributor_min_price'];
                }
                $product_data->prices=$price;
            }
            if($user_type == 'wholeseller')
            {
                if($prices['wholeseller_min_price'] != $prices['wholeseller_max_price'])
                {
                    $price='₹'.$prices['wholeseller_min_price'].' - ₹'. $prices['wholeseller_max_price'];
                }
                else
                {
                    $price='₹'.$prices['wholeseller_min_price'];
                }
                $product_data->prices=$price;
            }
        }

        return $product_list;
    }

    public function salesMemberDistributorList(Request $request)
    {
       return AssignDealer::where('sales_member_id',Auth::user()->id)->with(['dealer.businessDetail'])->simplepaginate(10);
    }

    public function customerHome(Request $request)
    {
        $sliders = AppSetting::where('type','slider')->get();
        foreach($sliders as $slider)
        {
            $slider->image = asset('public/'.api_asset($slider->image));
        }

        $banners = AppSetting::where('type','banner')->get();
        foreach($banners as $banner)
        {
            $banner->image = asset('public/'.api_asset($banner->image));
        }

        $categories = Category::select('id','name','icon')->where('is_active',1)->get();

        foreach($categories as $category)
        {
            $category->icon=asset('public/'.api_asset($category->icon));
        }

        $brands = Brnad::select('id','name','icon')->where('is_active',1)->get();

        foreach($brands as $brand)
        {
            $brand->icon=asset('public/'.api_asset($brand->icon));
        }

        $flash_deals=Offer::select('id','title','description','image','end_date_time')->where('is_active',1)->where('type','flash_deal')->whereDate('start_date_time', '<=', date('Y-m-d H:i'))->whereDate('end_date_time', '>=', date('Y-m-d H:i'))->get();
        foreach($flash_deals as $flash_deal)
        {
            $flash_deal->image = asset('public/'.api_asset($flash_deal->image));
            $flash_deal->products = OfferProduct::select('product_id','product_price','product_offer_price')->where('offer_id',$flash_deal->id)->get();
            foreach($flash_deal->products as $product)
            {
                $pro = Product::where('id',$product->product_id)->first();
                $product->name = $pro->name;
                $product->thumbnail_image = asset('public/'.api_asset($pro->thumbnail_image));
                $product->discount_amount = $product->product_price - $product->product_offer_price;
            }
        }

        $new_arrivals = Product::select('id','name','thumbnail_image','retailer_selling_price','retailer_discount_type','retailer_discount')->where('is_new_arrival',1)->take(10)->get();
        foreach($new_arrivals as $new_arrival)
        {
            $new_arrival->thumbnail_image = asset('public/'.api_asset($new_arrival->thumbnail_image));
            if($new_arrival->retailer_discount_type == 'percent')
            {
                $amount = ($new_arrival->retailer_selling_price*$new_arrival->retailer_discount)/100;
            }
            else
            {
                $amount = $new_arrival->retailer_discount;
            }
            $new_arrival->price = $new_arrival->retailer_selling_price;
            $new_arrival->discount_amount = $amount;
            $new_arrival->discounted_amount = $new_arrival->retailer_selling_price - $amount;
        }

        $features = Product::select('id','name','thumbnail_image','retailer_selling_price','retailer_discount_type','retailer_discount')->where('is_feature',1)->take(10)->get();
        foreach($features as $feature)
        {
            $feature->thumbnail_image = asset('public/'.api_asset($feature->thumbnail_image));
            if($feature->retailer_discount_type == 'percent')
            {
                $amount = ($feature->retailer_selling_price*$feature->retailer_discount)/100;
            }
            else
            {
                $amount = $feature->retailer_discount;
            }
            $feature->price = $feature->retailer_selling_price;
            $feature->discount_amount = $amount;
            $feature->discounted_amount = $feature->retailer_selling_price - $amount;
        }

        $best_sellers = Product::select('id','name','thumbnail_image','retailer_selling_price','retailer_discount_type','retailer_discount')->where('is_bestseller',1)->take(10)->get();
        foreach($best_sellers as $best_seller)
        {
            $best_seller->thumbnail_image = asset('public/'.api_asset($best_seller->thumbnail_image));
            if($best_seller->retailer_discount_type == 'percent')
            {
                $amount = ($best_seller->retailer_selling_price*$best_seller->retailer_discount)/100;
            }
            else
            {
                $amount = $best_seller->retailer_discount;
            }
            $best_seller->price = $best_seller->retailer_selling_price;
            $best_seller->discount_amount = $amount;
            $best_seller->discounted_amount = $best_seller->retailer_selling_price - $amount;
        }

        $trendings = Product::select('id','name','thumbnail_image','retailer_selling_price','retailer_discount_type','retailer_discount')->where('is_trending',1)->take(10)->get();
        foreach($trendings as $trending)
        {
            $trending->thumbnail_image = asset('public/'.api_asset($trending->thumbnail_image));
            if($trending->retailer_discount_type == 'percent')
            {
                $amount = ($trending->retailer_selling_price*$trending->retailer_discount)/100;
            }
            else
            {
                $amount = $trending->retailer_discount;
            }
            $trending->price = $trending->retailer_selling_price;
            $trending->discount_amount = $amount;
            $trending->discounted_amount = $trending->retailer_selling_price - $amount;
        }

        $feature_categories = Category::select('id','name','icon')->where('is_active',1)->where('is_feature',1)->get();

        foreach($feature_categories as $feature_category)
        {
            $feature_category->icon = asset('public/'.api_asset($feature_category->icon));
            $feature_category->products = Product::select('id','name','thumbnail_image','retailer_selling_price','retailer_discount_type','retailer_discount')->where('is_active',1)->whereJsonContains('category_id',''.$feature_category->id)->take(10)->get();
            foreach($feature_category->products as $product)
            {
                $pro = Product::where('id',$product->id)->first();
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
        }

        return response()->json([
            'sliders'=>$sliders->pluck('image'),
            'banners'=>$banners->pluck('image'),
            'categories'=>$categories,
            'brands'=>$brands,
            'flash_deals'=>$flash_deals,
            'new_arrivals'=>$new_arrivals->makeHidden(['retailer_selling_price','retailer_discount_type','retailer_discount']),
            'best_sellers'=>$best_sellers->makeHidden(['retailer_selling_price','retailer_discount_type','retailer_discount']),
            'trendings'=>$trendings  ->makeHidden(['retailer_selling_price','retailer_discount_type','retailer_discount']),
            'feature_categories'=>$feature_categories,
            'features'=>$features->makeHidden(['retailer_selling_price','retailer_discount_type','retailer_discount'])
        ]);
    }

    public function getSubCategory(Request $request)
    {
        $sub_categories = SubCategory::select('id','name','image')->where('is_active',1)->whereJsonContains('category_id',''.$request->category_id)->get();
        foreach($sub_categories as $sub_category)
        {
            $sub_category->image = asset('public/'.api_asset($sub_category->image));
        }

        return response()->json([
            'sub_categories'=>$sub_categories,
        ]);
    }

    public function getCategory(Request $request)
    {
        $category_ids = [];
        $lists=Product::where('brand_id',$request->brand_id)->pluck('category_id');
        foreach($lists as $datas)
        {
            foreach($datas as $da)
            {
                array_push($category_ids,$da);
            }
        }
        $categories = Category::select('id','name','icon')->where('is_active',1)->whereIn('id',array_values(array_unique($category_ids)))->orderBy('priority','asc')->get();
        foreach($categories as $category){
            $brd = Brnad::where('id',$request->brand_id)->first();
            if($brd){
                $cat_img = '';
                foreach($brd->cat_id as $key=>$cat)
                {
                    if($category->id == $cat)
                    {
                        $cat_img = $brd->cat_img[$key];
                    }
                }
                if(!$cat_img)
                {
                    $cat_img = $category->icon;
                }
                $category->icon = asset('public/'.api_asset($cat_img));;
            }
        }
        return response()->json([
            'categories'=>$categories,
        ]);
    }

}
