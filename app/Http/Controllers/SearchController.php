<?php

namespace App\Http\Controllers;

use App\Models\Admin\Color;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;

class SearchController extends Controller
{

    public function productSearch(Request $request)
    {
        $search=$request->search;
        $list=Product::where(function ($query) use ($search){
            $query->where('name','like','%'.$search.'%')
                  ->orWhere('variant_name','like','%'.$search.'%');
        });;
        if($request->ajax())
        {
            $list=$list->take(7)->get();
            return vieW('frontend.layouts.search',compact('list'));
        }
        else
        {
            if($request->category_filler)
            {
                $list=$list->whereJsonContains('category_id',''.$request->category_filler);
            }
            if($request->subcategory_filler)
            {
                $list=$list->whereJsonContains('subcategory_id',''.$request->subcategory_filler);
            }
            if($request->subsubcategory_filler)
            {
                $list=$list->whereJsonContains('subsubcategory_id',''.$request->subsubcategory_filler);
            }
            $list=$list->paginate(12);
            return vieW('frontend.product_list',compact('list'));;
        }
    }

    public function productFillter(Request $request)
    {
        $condition_category=[];
        $search_category=$request->category_filler;
        if(!empty($search_category))
        {
            if(!is_array($search_category))
            {
                $search_category=json_decode($request->category_filler);
            }
            foreach($search_category as $category)
            {
                array_push($condition_category,['category_id'=>$category]);
            }
        }

        $list=Product::where(function ($query) use ($condition_category){
            foreach ($condition_category as $key=>$value)
            {
                $query->orWhereJsonContains('category_id',$value['category_id']);
            }
            });

        if($request->color_filler)
        {
            $list=$list->whereIn('colors',$request->color_filler);
        }
        if($request->discount_filler)
        {
            $list=$list->where('retailer_discount',$request->discount_filler);
        }
        if($request->price_filler)
        {
            if($request->price_filler != 'more than 100000')
            {
                $range=explode('-',$request->price_filler);
                $list=$list->whereBetween('retailer_selling_price',$range);

            }
            else
            {
                $list=$list->where('retailer_selling_price','>',100000);
            }
        }

        $sort_by = 'asc';
        $sort_type = 'name';
        if($request->sort_by == 'desc')
        {
            $sort_by = 'desc';
            $sort_type = 'name';
        }
        if($request->sort_by == 'pasc')
        {
            $sort_by = 'asc';
            $sort_type = 'retailer_selling_price';
        }
        if($request->sort_by == 'pdesc')
        {
            $sort_by = 'desc';
            $sort_type = 'retailer_selling_price';
        }

        if($request->subcat)
        {
            $subcat_slug=SubCategory::where('slug',$request->subcat)->first();
            $list=$list->whereJsonContains('subcategory_id',''.$subcat_slug->id);
        }

        if($request->brand_filler)
        {
            $list=$list->where('brand_id',$request->brand_filler);
        }

        if($request->search)
        {
            $search=$request->search;
            $list=$list->where(function ($query) use ($search){
                $query->where('name','like','%'.$search.'%')
                      ->orWhere('variant_name','like','%'.$search.'%');
            });
        }

        $list=$list->orderBy($sort_type,$sort_by)->paginate(12);

        return view('frontend.product_list_data',compact('list'));
    }

}
