<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\SubSubCategory;
use App\Http\Controllers\Controller;

class SubSubCategoryController extends Controller
{

    public function index(Request $request)
    {
        $condition_category=[];
        $condition_subcategory=[];
        $search=$request->key;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
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

        $list=SubSubCategory::where(function ($query) use ($condition_category){
            foreach ($condition_category as $key=>$value)
            {
                $query->orWhereJsonContains('category_id',$value['category_id']);
            }
            })->where(function ($query) use ($condition_subcategory){
                foreach ($condition_subcategory as $key=>$value)
                {
                    $query->orWhereJsonContains('subcategory_id',$value['subcategory_id']);
                }
                });
            if($search)
            {
                $list=$list->where('name','like','%'.$search.'%');
            }
        $page=$request->page;
        $list=$list->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('admin.sub-sub-categories.index',['key='.$search.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$page])->with('success', 'SubSubCategory Deleted Successfully !!');
        }

        return view('backend.products.sub_sub_categories.index',compact('list','search','search_category','search_subcategory'),['page_title'=>'SubSubCategory List']);
    }

    public function create(Request $request)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
        $page=$request->page;
        return view('backend.products.sub_sub_categories.create',compact('key','page','search_category','search_subcategory'),['page_title'=>'Add SubSubCategory']);
    }

    public function store(Request $request)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
        $page=$request->page;

        $sub_sub_category=new SubSubCategory;
        $sub_sub_category->slug=strtolower(str_replace(" ","-",$request->name)).'-'.substr(md5(rand(1,4)),0,4);
        $sub_sub_category->name=$request->name;
        $sub_sub_category->category_id=$request->category_id;
        $sub_sub_category->subcategory_id=$request->subcategory_id;
        $sub_sub_category->descrption=$request->description;
        if($request->meta_name)
        {
            $sub_sub_category->meta_name=$request->meta_name;
        }
        else
        {
            $sub_sub_category->meta_name=$request->name;
        }
        if($request->meta_description)
        {
            $sub_sub_category->meta_descrption=$request->meta_description;
        }
        else
        {
            $sub_sub_category->meta_descrption=$request->description;
        }

        $sub_sub_category->save();

        return redirect()->route('admin.sub-sub-categories.index',['key='.$key.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$page])->with('success','SubSubCategory Added!');
    }

    public function show(Request $request,SubSubCategory $subSubCategory)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
        $page=$request->page;
        SubSubCategory::where('id',$subSubCategory->id)->update([
            'is_active'=>$request->is_active
        ]);
        if($request->is_active)
        {
            return redirect()->route('admin.sub-sub-categories.index',['key='.$key.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$page])->with('success','SubSubCategory Active!');
        }
        else
        {
            return redirect()->route('admin.sub-sub-categories.index',['key='.$key.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$page])->with('error','SubSubCategory Deactive!');
        }
    }

    public function edit(Request $request,SubSubCategory $subSubCategory)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
        $page=$request->page;
        return view('backend.products.sub_sub_categories.edit',compact('subSubCategory','key','page','search_category','search_subcategory'),['page_title'=>'Edit SubSubCategory']);
    }

    public function update(Request $request, SubSubCategory $subSubCategory)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
        $page=$request->page;

        $sub_sub_category=SubSubCategory::find($subSubCategory->id);
        $sub_sub_category->name=$request->name;
        $sub_sub_category->category_id=$request->category_id;
        $sub_sub_category->subcategory_id=$request->subcategory_id;
        $sub_sub_category->descrption=$request->description;
        if($request->meta_name)
        {
            $sub_sub_category->meta_name=$request->meta_name;
        }
        else
        {
            $sub_sub_category->meta_name=$request->name;
        }
        if($request->meta_description)
        {
            $sub_sub_category->meta_descrption=$request->meta_description;
        }
        else
        {
            $sub_sub_category->meta_descrption=$request->description;
        }

        $sub_sub_category->save();

        return redirect()->route('admin.sub-sub-categories.index',['key='.$key.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$page])->with('success','SubSubCategory Added!');
    }

    public function destroy(Request $request,$id)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $search_subcategory=$request->search_subcategory_id;
        $page=$request->page;
        SubSubCategory::where('id',$id)->delete();

        return redirect()->route('admin.sub-sub-categories.index',['key='.$key.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$page])->with('error','SubSubCategory Deleted!');
    }

    public function getSubSubCategoriesBySubCategory(Request $request)
    {
        $condition_subcategory=[];
        $search_subcategory=$request->subcategory_ids;

        if(!empty($search_subcategory))
        {
            if(!is_array($search_subcategory))
            {
                $search_subcategory=json_decode($subcategory_id);
            }
            foreach($search_subcategory as $subcategory)
            {
                array_push($condition_subcategory,['subcategory_id'=>$subcategory]);
            }
            $list=SubSubCategory::select('id','subcategory_id','name')->where(function ($query) use ($condition_subcategory){
                foreach ($condition_subcategory as $key=>$value)
                {
                    $query->orWhereJsonContains('subcategory_id',$value['subcategory_id']);
                }
                })->get();
        }
        else
        {
            $list=[];
        }

        return $list;
    }
}
