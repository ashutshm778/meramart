<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Offer;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\OfferProduct;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{

    public function index()
    {
        $list=Offer::withCount('offer_product')->paginate(10);
        return view('backend.offer.index',compact('list'),['page_title'=>'Offer List']);
    }

    public function create()
    {
        return view('backend.offer.create',['page_title'=>'Add Offer']);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request,Offer $offer)
    {
        if($request->featured)
        {
            $offer->is_featured = $request->featured;
            $offer->save();
        }
        else
        {
            $offer->is_active = $request->active;
            $offer->save();
        }

        return back()->with('success','Offer Status Change Successfully!');
    }

    public function edit(Offer $offer)
    {
        $local_products = OfferProduct::where('offer_id',$offer->id)->get();
        $arr=[];
        foreach($local_products as $local_product)
        {
            $arr[]=array('property_id'=>$local_product->product_id,'value'=>true);
        }

        $local_products = $arr;
        return view('backend.offer.edit',compact('offer','local_products'),['page_title'=>'Edit Offer']);
    }

    public function update(Request $request, Offer $offer)
    {
        return $request->all();
    }

    public function destroy($id)
    {
        Offer::where('id',$id)->delete();

        return back()->with('error','Offer Deleted Successfully!');
    }

    public function offerProduct(Request $request)
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

        return response()->view('backend.offer.product_index', compact('products'));
    }

    public function getOfferProductTable(Request $request)
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
        return view('backend.offer.product_table',compact('offer_products','offer_id'));
    }
}
