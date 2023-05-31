<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\SubCategory;
use App\Http\Controllers\Controller;
use App\Models\Admin\Attribute;

class SubCategoryController extends Controller
{

    public function index(Request $request)
    {
        $condition_category=[];
        $search=$request->key;
        $search_category=$request->search_category_id;
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

        $list=SubCategory::where(function ($query) use ($condition_category){
            foreach ($condition_category as $key=>$value)
            {
                $query->orWhereJsonContains('category_id',$value['category_id']);
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
            return redirect()->route('admin.sub-categories.index',['key='.$search.'&search_category_id='.$search_category.'&page='.$page])->with('success', 'SubCategory Deleted Successfully !!');
        }

        return view('backend.products.sub_categories.index',compact('list','search','search_category'),['page_title'=>'SubCategory List']);
    }

    public function create(Request $request)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;
        return view('backend.products.sub_categories.create',compact('key','page','search_category'),['page_title'=>'Add SubCategory']);
    }

    public function store(Request $request)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;

        $sub_category=new SubCategory;
        $sub_category->slug=strtolower(str_replace(" ","-",$request->name)).'-'.substr(md5(rand(1,4)),0,4);
        $sub_category->name=$request->name;
        $sub_category->category_id=$request->category_id;
        $sub_category->image=$request->image;
        $sub_category->descrption=$request->description;
        if($request->meta_name)
        {
            $sub_category->meta_name=$request->meta_name;
        }
        else
        {
            $sub_category->meta_name=$request->name;
        }
        if($request->meta_description)
        {
            $sub_category->meta_descrption=$request->meta_description;
        }
        else
        {
            $sub_category->meta_descrption=$request->description;
        }

        $sub_category->save();

        return redirect()->route('admin.sub-categories.index',['key='.$key.'&search_category_id='.$search_category.'&page='.$page])->with('success','SubCategory Added!');
    }

    public function show(Request $request,SubCategory $subCategory)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;
        SubCategory::where('id',$subCategory->id)->update([
            'is_active'=>$request->is_active
        ]);
        if($request->is_active)
        {
            return redirect()->route('admin.sub-categories.index',['key='.$key.'&search_category_id='.$search_category.'&page='.$page])->with('success','SubCategory Active!');
        }
        else
        {
            return redirect()->route('admin.sub-categories.index',['key='.$key.'&search_category_id='.$search_category.'&page='.$page])->with('error','SubCategory Deactive!');
        }
    }

    public function edit(Request $request,SubCategory $subCategory)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;
        return view('backend.products.sub_categories.edit',compact('subCategory','key','page','search_category'),['page_title'=>'Edit SubCategory']);
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;

        $sub_category=SubCategory::find($subCategory->id);

        $sub_category->name=$request->name;
        $sub_category->category_id=$request->category_id;
        $sub_category->descrption=$request->description;
        $sub_category->image=$request->image;
        if($request->meta_name)
        {
            $sub_category->meta_name=$request->meta_name;
        }
        else
        {
            $sub_category->meta_name=$request->name;
        }
        if($request->meta_description)
        {
            $sub_category->meta_descrption=$request->meta_description;
        }
        else
        {
            $sub_category->meta_descrption=$request->description;
        }

        $sub_category->save();

        return redirect()->route('admin.sub-categories.index',['key='.$key.'&search_category_id='.$search_category.'&page='.$page])->with('success','SubCategory Updated!');
    }

    public function destroy(Request $request,$id)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;
        SubCategory::where('id',$id)->delete();

        return redirect()->route('admin.sub-categories.index',['key='.$key.'&search_category_id='.$search_category.'&page='.$page])->with('error','SubCategory Deleted!');
    }

    public function getSubCategoriesByCategory(Request $request)
    {
        $condition_category=[];
        $search_category=$request->category_ids;

        if(!empty($search_category))
        {
            if(!is_array($search_category))
            {
                $search_category=json_decode($request->category_ids);
            }
            foreach($search_category as $category)
            {
                array_push($condition_category,['category_id'=>$category]);
            }
            $list=SubCategory::select('id','category_id','name')->where(function ($query) use ($condition_category){
                foreach ($condition_category as $key=>$value)
                {
                    $query->orWhereJsonContains('category_id',$value['category_id']);
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
