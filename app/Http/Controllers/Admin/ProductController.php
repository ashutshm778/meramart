<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Attribute;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $condition_category=[];
        $condition_subcategory=[];
        $condition_subsubcategory=[];
        $search_brand=$request->search_brand_id;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
        $search_subsubcategory=$request->search_subsubcategory_id;
        $search=$request->key;
        if(!empty($search_category))
        {
            if(!is_array($search_category))
            {
                $search_category=json_decode($request->search_category_id);
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
                $search_subcategory=json_decode($request->search_subcategory_id);
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
                $search_subsubcategory=json_decode($request->search_subsubcategory_id);
            }
            foreach($search_subsubcategory as $subsubcategory)
            {
                array_push($condition_subsubcategory,['subsubcategory_id'=>$subsubcategory]);
            }
        }

        $list=Product::where(function ($query) use ($condition_category){
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
                    })->groupBy('product_group_id');

        if($search_brand)
        {
            $list=$list->where('brand_id',$search_brand);
        }

        if($search)
        {
            $list=$list->where(function ($query) use ($search) {
                $query->where('name','like','%'.$search.'%')
                      ->orWhere('tags','like','%'.$search.'%');
            });
        }
        $page=$request->page;
        $list=$list->orderBy('brand_id','asc')->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('products.index',['key='.$search.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&search_subsubcategory_id='.$search_subsubcategory.'&search_brand_id='.$search_brand.'&page='.$page])->with('success', 'Product Deleted Successfully !!');
        }

        return view('backend.products.products.index',compact('list','search','search_category','search_subcategory','search_subsubcategory','search_brand'),['page_title'=>'Product List']);
    }

    public function create(Request $request)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
        $search_subsubcategory=$request->search_subsubcategory_id;
        $search_brand=$request->search_brand_id;
        $page=$request->page;
        return view('backend.products.products.create',compact('key','page','search_category','search_subcategory','search_subsubcategory','search_brand'),['page_title'=>'Add Product']);
    }

    public function store(Request $request)
    {
        $product_group_id=Product::select('product_group_id')->groupBy('product_group_id')->latest()->first();
        if($product_group_id)
        {
            $product_group_id=$product_group_id->product_group_id+1;
        }
        else
        {
            $product_group_id=1;
        }
        foreach($request->sku as $key=>$data)
        {
            $product = new Product;
            $product->added_by=Auth::user()->id;
            $product->product_group_id=$product_group_id;
            if($request->variant_name)
            {
                $product->slug=strtolower(str_replace(" ","-",$request->variant_name[$key])).'-'.generateRandomString(4);
                $product->variant_name=$request->variant_name[$key];
                $num=$key+1;
                $colors='colors'.$num;
                $product->colors=$request->$colors;
                $choice_attributes='choice_attributes_'.$num;
                if($request->$choice_attributes)
                {
                    $product->attribute=$request->$choice_attributes;
                }
                else
                {
                    $product->attribute='';
                }
                $choice_option='choice_option_'.$num;
                if($request->$choice_option)
                {
                    $product->attribute_value=$request->$choice_option;
                }
                else
                {
                    $product->attribute_value='';
                }
            }
            else
            {
                $product->slug=strtolower(str_replace(" ","-",$request->name)).'-'.substr(md5(rand(1,4)),0,4);
                $product->variant_name='';
                $product->colors='';
                $product->attribute='';
                $product->attribute_value='';
            }

            $product->category_id=$request->category_id;
            $product->subcategory_id=$request->subcategory_id;
            $product->subsubcategory_id=$request->subsubcategory_id;
            $product->brand_id=$request->brand_id;
            $product->name=$request->name;
            $product->description=$request->description;
            $product->thumbnail_image=$request->thumbnail_image[$key];
            $product->gallery_image=$request->gallery_image[$key];
            // $product->purchase_price=$request->purchase_price[$key];
            // $product->mrp_price=$request->mrp_price[$key];
            if(featureActivation('retailer') == '1'){
                if($request->retailer_selling_price[$key]){
                    $product->retailer_selling_price=$request->retailer_selling_price[$key];
                }
                $product->retailer_discount_type=$request->retailer_discount_type[$key];
                if($request->retailer_discount[$key]){
                    $product->retailer_discount=$request->retailer_discount[$key];
                }
                $product->retailer_min_qty=$request->retailer_min_qty[$key];
                $product->retailer_max_qty=$request->retailer_max_qty[$key];
                if(featureActivation('mlm') == '1'){
                    if($request->retailer_point[$key]){
                        $product->retailer_point=$request->retailer_point[$key];
                    }
                }
            }

            if(featureActivation('distributor') == '1'){
                if($request->distributor_selling_price[$key]){
                    $product->distributor_selling_price=$request->distributor_selling_price[$key];
                }
                $product->distributor_discount_type=$request->distributor_discount_type[$key];
                if($request->distributor_discount[$key]){
                    $product->distributor_discount=$request->distributor_discount[$key];
                }
                $product->distributor_min_qty=$request->distributor_min_qty[$key];
                if(featureActivation('mlm') == '1'){
                    if($request->distributor_point[$key]){
                        $product->distributor_point=$request->distributor_point[$key];
                    }
                }
            }

            if(featureActivation('wholeseller') == '1'){
                if($request->wholeseller_selling_price[$key]){
                    $product->wholeseller_selling_price=$request->wholeseller_selling_price[$key];
                }
                $product->wholeseller_discount_type=$request->wholeseller_discount_type[$key];
                if($request->wholeseller_discount[$key]){
                    $product->wholeseller_discount=$request->wholeseller_discount[$key];
                }
                $product->wholeseller_min_qty=$request->wholeseller_min_qty[$key];
                if(featureActivation('mlm') == '1'){
                    if($request->wholeseller_point[$key]){
                        $product->wholeseller_point=$request->wholeseller_point[$key];
                    }
                }
            }

            $product->unit=$request->unit;
            $product->hsn_code=$request->hsn_code;
            $product->sku=$request->sku[$key];
            $product->tax_type=$request->tax_type;
            if($request->tax_amount){
                $product->tax_amount=$request->tax_amount;
            }
            $product->shipping_type=$request->shipping_type;
            if($request->shipping_amount){
                $product->shipping_amount=$request->shipping_amount;
            }
            $product->specification=$request->specification;

            $tags = array();
            if($request->tags[0] != null){
                foreach (json_decode($request->tags[0]) as $keys => $tag) {
                    array_push($tags, $tag->value);
                }
            }

            $product->tags=implode(',',$tags);
            $product->video_link=$request->video_link[$key];
            $product->barcode_id=$request->barcode_id[$key];

            if(isset($request->meta_title[$key]))
            {
                if($request->meta_title[$key])
                {
                    $product->meta_title=$request->meta_title[$key];
                }
                else
                {
                    $product->meta_title=$request->name[$key];
                }
                if($request->meta_key_word[$key])
                {
                    $product->meta_key_word=$request->meta_key_word[$key];
                }
                else
                {
                    $product->meta_key_word=implode(',',$tags);
                }
                if($request->meta_description[$key])
                {
                    $product->meta_description=$request->meta_description[$key];
                }
                else
                {
                    $product->meta_description=$request->description;
                }
                if($request->meta_image[$key])
                {
                    $product->meta_description=$request->meta_description[$key];
                }
                else
                {
                    $product->meta_description=$request->thumbnail_image[$key];
                }
            }

            $product->save();
        }

        return redirect()->route('admin.products.index')->with('success','Product Added Successfully!');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product,Request $request)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
        $search_subsubcategory=$request->search_subsubcategory_id;
        $search_brand=$request->search_brand_id;
        $page=$request->page;

        return view('backend.products.products.edit',compact('product','key','page','search_category','search_subcategory','search_subsubcategory','search_brand'),['page_title'=>'Edit Product']);
    }

    public function update(Request $request,$id)
    {
        $product_group_id=Product::select('product_group_id')->where('id',$id)->first();

        $product_group_id=$product_group_id->product_group_id;

        foreach($request->sku as $key=>$data)
        {
            if(isset($request->variant_id[$key]))
            {
                $product =Product::find($request->variant_id[$key]);
            }
            else
            {
                $product = new Product;
                if($request->variant_name)
                {
                    $product->slug=strtolower(str_replace(" ","-",$request->variant_name[$key])).'-'.generateRandomString(4);
                }
                else
                {
                    $product->slug=strtolower(str_replace(" ","-",$request->name)).'-'.substr(md5(rand(1,4)),0,4);
                }
            }

            $product->added_by=Auth::user()->id;
            $product->product_group_id=$product_group_id;
            if($request->variant_name)
            {
                $product->variant_name=$request->variant_name[$key];
                $num=$key+1;
                $colors='colors'.$num;
                $product->colors=$request->$colors;
                $choice_attributes='choice_attributes_'.$num;
                if($request->$choice_attributes)
                {
                    $product->attribute=$request->$choice_attributes;
                }
                else
                {
                    $product->attribute='';
                }
                $choice_option='choice_option_'.$num;
                if($request->$choice_option)
                {
                    $product->attribute_value=$request->$choice_option;
                }
                else
                {
                    $product->attribute_value='';
                }
            }
            else
            {
                $product->variant_name='';
                $product->colors='';
                $product->attribute='';
                $product->attribute_value='';
            }

            $product->category_id=$request->category_id;
            $product->subcategory_id=$request->subcategory_id;
            $product->subsubcategory_id=$request->subsubcategory_id;
            $product->brand_id=$request->brand_id;
            $product->name=$request->name;
            $product->description=$request->description;
            $product->thumbnail_image=$request->thumbnail_image[$key];
            $product->gallery_image=$request->gallery_image[$key];
            // $product->purchase_price=$request->purchase_price[$key];
            // $product->mrp_price=$request->mrp_price[$key];
            if(featureActivation('retailer') == '1'){
                if($request->retailer_selling_price[$key]){
                    $product->retailer_selling_price=$request->retailer_selling_price[$key];
                }
                $product->retailer_discount_type=$request->retailer_discount_type[$key];
                if($request->retailer_discount[$key]){
                    $product->retailer_discount=$request->retailer_discount[$key];
                }
                $product->retailer_min_qty=$request->retailer_min_qty[$key];
                $product->retailer_max_qty=$request->retailer_max_qty[$key];
                if(featureActivation('mlm') == '1'){
                    if($request->retailer_point[$key]){
                        $product->retailer_point=$request->retailer_point[$key];
                    }
                }
            }

            if(featureActivation('distributor') == '1'){
                if($request->distributor_selling_price[$key]){
                    $product->distributor_selling_price=$request->distributor_selling_price[$key];
                }
                $product->distributor_discount_type=$request->distributor_discount_type[$key];
                if($request->distributor_discount[$key]){
                    $product->distributor_discount=$request->distributor_discount[$key];
                }
                $product->distributor_min_qty=$request->distributor_min_qty[$key];
                if(featureActivation('mlm') == '1'){
                    if($request->distributor_point[$key]){
                        $product->distributor_point=$request->distributor_point[$key];
                    }
                }
            }

            if(featureActivation('distributor') == '1'){
                if($request->wholeseller_selling_price[$key]){
                    $product->wholeseller_selling_price=$request->wholeseller_selling_price[$key];
                }
                $product->wholeseller_discount_type=$request->wholeseller_discount_type[$key];
                if($request->wholeseller_discount[$key]){
                    $product->wholeseller_discount=$request->wholeseller_discount[$key];
                }
                $product->wholeseller_min_qty=$request->wholeseller_min_qty[$key];
                if(featureActivation('mlm') == '1'){
                    if($request->wholeseller_point[$key]){
                        $product->wholeseller_point=$request->wholeseller_point[$key];
                    }
                }
            }

            $product->unit=$request->unit;
            $product->hsn_code=$request->hsn_code;
            $product->sku=$request->sku[$key];
            $product->tax_type=$request->tax_type;
            if($request->tax_amount){
                $product->tax_amount=$request->tax_amount;
            }
            $product->shipping_type=$request->shipping_type;
            if($request->shipping_amount){
                $product->shipping_amount=$request->shipping_amount;
            }
            $product->specification=$request->specification;

            $tags = array();
            if($request->tags[0] != null){
                foreach (json_decode($request->tags[0]) as $keys => $tag) {
                    array_push($tags, $tag->value);
                }
            }

            $product->tags=implode(',',$tags);
            $product->video_link=$request->video_link[$key];
            $product->barcode_id=$request->barcode_id[$key];

            if(isset($request->meta_title[$key]))
            {
                if($request->meta_title[$key])
                {
                    $product->meta_title=$request->meta_title[$key];
                }
                else
                {
                    $product->meta_title=$request->name[$key];
                }
                if($request->meta_key_word[$key])
                {
                    $product->meta_key_word=$request->meta_key_word[$key];
                }
                else
                {
                    $product->meta_key_word=implode(',',$tags);
                }
                if($request->meta_description[$key])
                {
                    $product->meta_description=$request->meta_description[$key];
                }
                else
                {
                    $product->meta_description=$request->description;
                }
                if($request->meta_image[$key])
                {
                    $product->meta_image=$request->meta_description[$key];
                }
                else
                {
                    $product->meta_image=$request->thumbnail_image[$key];
                }
            }

            $product->save();
        }

        return redirect()->route('admin.products.index')->with('success','Product Updated Successfully!');
    }

    public function destroy($id)
    {
        Product::where('id',$id)->delete();

        return back()->with('success','Product Delete Successfully!');
    }

    public function productStatusIndex(Request $request)
    {
        $condition_category=[];
        $condition_subcategory=[];
        $condition_subsubcategory=[];
        $search_brand=$request->search_brand_id;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
        $search_subsubcategory=$request->search_subsubcategory_id;
        $search=$request->key;
        if(!empty($search_category))
        {
            if(!is_array($search_category))
            {
                $search_category=json_decode($request->search_category_id);
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
                $search_subcategory=json_decode($request->search_subcategory_id);
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
                $search_subsubcategory=json_decode($request->search_subsubcategory_id);
            }
            foreach($search_subsubcategory as $subsubcategory)
            {
                array_push($condition_subsubcategory,['subsubcategory_id'=>$subsubcategory]);
            }
        }

        $list=Product::where(function ($query) use ($condition_category){
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
            $list=$list->whereJsonContains('brand_id',$search_brand);
        }

        if($search)
        {
            $list=$list->where('name','like','%'.$search.'%');
        }
        $page=$request->page;
        $list=$list->paginate(10);

        return view('backend.products.products.status',compact('list','search','search_category','search_subcategory','search_subsubcategory','search_brand'),['page_title'=>'Product Status']);
    }

    public function productStatusUpdate(Request $request,$id,$status)
    {
        Product::where('id',$id)->update([
            $request->type=>$status
        ]);

        return 1;
    }

    public function lowStockProduct()
    {
        $list = Product::where('current_stock','<',10)->orderBy('name','asc')->paginate(10);

        return view('backend.products.products.low_stock',compact('list'),['page_title'=>'Low Stocks Product']);
    }
}
