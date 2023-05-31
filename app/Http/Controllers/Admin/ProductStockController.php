<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\ProductStock;
use App\Http\Controllers\Controller;

class ProductStockController extends Controller
{

    public function index()
    {
        $list=ProductStock::orderBy('id','desc')->groupBy('pi_number')->paginate(10);

        return view('backend.products.product_stocks.index',compact('list'),['page_title'=>'Product Stocks']);
    }

    public function create()
    {
        return view('backend.products.product_stocks.create',['page_title'=>'Add Product Stocks']);
    }

    public function store(Request $request)
    {
        $pi_number=ProductStock::groupBy('pi_number')->latest()->first();
        if($pi_number)
        {
            $pi_number = $pi_number->pi_number+1;
        }
        else
        {
            $pi_number = 100001;
        }
        foreach($request->ids as $key=>$id)
        {
            $product_stock = new ProductStock;
            $product_stock->pi_number = $pi_number;
            $product_stock->vendor_id = $request->vendor;
            $product_stock->product_id = $id;
            $product_stock->purchase_price = $request->purchase_price[$key];
            $product_stock->mrp_price = $request->mrp_price[$key];
            $product_stock->current_stock = $request->stockes[$key];
            $product_stock->save();

            $product = Product::find($id);
            $product->current_stock = $product->current_stock+$request->stockes[$key];
            if(featureActivation('retailer') == '1'){
                $product->retailer_selling_price = $request->retailer_selling_price[$key];
            }
            if(featureActivation('distributor') == '1'){
                $product->distributor_selling_price = $request->distributor_selling_price[$key];
            }
            if(featureActivation('wholeseller') == '1'){
                $product->wholeseller_selling_price = $request->wholeseller_selling_price[$key];
            }
            $product->save();
        }

    }

    public function show($pi_number)
    {
        $list = ProductStock::where('pi_number',$pi_number)->paginate(20);

        return view('backend.products.product_stocks.show',compact('list'),['page_title'=>'Product Stocks List']);
    }

    public function edit(ProductStock $productStock)
    {
        //
    }

    public function update(Request $request, ProductStock $productStock)
    {
        //
    }

    public function destroy(ProductStock $productStock)
    {
        //
    }

    public function getProduct(Request $request)
    {
        $condition_category=[];
        $condition_subcategory=[];
        $condition_subsubcategory=[];
        $search_brand=$request->brand_id;
        $search_price_range=$request->price_range;
        $search_category=$request->category_id;
        $search_subcategory=$request->sub_category_id;
        $search_subsubcategory=$request->sub_sub_category_id;
        $search=$request->key;
        if(!empty($search_category))
        {
            if(!is_array($search_category))
            {
                $search_category=json_decode($request->category_id);
            }
            foreach($search_category as $category)
            {
                array_push($condition_category,['category_id'=>$category]);
            }
        }

        if(!empty($search_subcategory))
        {
            if(!is_array($search_subcategory))
            {
                $search_subcategory=json_decode($request->sub_category_id);
            }
            foreach($search_subcategory as $subcategory)
            {
                array_push($condition_subcategory,['subcategory_id'=>$subcategory]);
            }
        }

        if(!empty($search_subsubcategory))
        {
            if(!is_array($search_subsubcategory))
            {
                $search_subsubcategory=json_decode($request->sub_sub_category_id);
            }
            foreach($search_subsubcategory as $subsubcategory)
            {
                array_push($condition_subsubcategory,['subsubcategory_id'=>$subsubcategory]);
            }
        }

        $products=Product::where(function ($query) use ($condition_category){
            foreach ($condition_category as $key=>$value)
            {
                $query->orWhereJsonContains('category_id',$value['category_id']);
            }
            })->where(function ($query) use ($condition_subcategory){
                foreach ($condition_subcategory as $key=>$value)
                {
                    $query->orWhereJsonContains('subcategory_id',$value['subcategory_id']);
                }
                })->where(function ($query) use ($condition_subsubcategory){
                    foreach ($condition_subsubcategory as $key=>$value)
                    {
                        $query->orWhereJsonContains('subsubcategory_id',$value['subsubcategory_id']);
                    }
                });

        if($search_brand)
        {
            $products=$products->where('brand_id',$search_brand);
        }
        if($search_price_range)
        {
            if($search_price_range != 'More than 100000')
            {
                $range=explode('-',$search_price_range);
                $products=$products->whereBetween('retailer_selling_price',$range);

            }
            else
            {
                $products=$products->where('retailer_selling_price','<=',1000000);
            }
        }
        if($search)
        {
            $products=$products->where('name','like','%'.$search.'%');
        }
        $page=$request->page;
        $products=$products->paginate(10);

        return response()->view('backend.products.product_stocks.product_index', compact('products'));
    }

    public function getProductTable(Request $request)
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
        return view('backend.products.product_stocks.product_table',compact('offer_products','offer_id'));
    }

}
