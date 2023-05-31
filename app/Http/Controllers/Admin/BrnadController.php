<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Brnad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrnadController extends Controller
{

    public function index(Request $request)
    {
        $list=Brnad::orderBy('name','asc');
        $search=$request->key;
        if(!empty($search))
        {
            $list=$list->where('name','like','%'.$search.'%');
        }

        $page=$request->page;
        $list=$list->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('admin.brands.index',['key='.$search.'&page='.$page])->with('success', 'Brand Deleted Successfully !!');
        }

        return view('backend.products.brands.index',compact('list','search'),['page_title'=>'Brand List']);
    }

    public function create(Request $request)
    {
        $key=$request->key;
        $page=$request->page;
        return view('backend.products.brands.create',compact('key','page'),['page_title'=>'Add Brand']);
    }

    public function store(Request $request)
    {
        $key=$request->key;
        $page=$request->page;

        $brand=new Brnad;
        $brand->slug=strtolower(str_replace(" ","-",$request->name)).'-'.substr(md5(rand(1,4)),0,4);
        $brand->name=$request->name;
        $brand->descrption=$request->description;
        $brand->icon=$request->icon;
        if($request->cat_id){
            $brand->cat_id=$request->cat_id;
            $brand->cat_img=$request->cat_img;
        }else{
            $brand->cat_id=[];
            $brand->cat_img=[];
        }
        if($request->meta_name)
        {
            $brand->meta_name=$request->meta_name;
        }
        else
        {
            $brand->meta_name=$request->name;
        }
        if($request->meta_description)
        {
            $brand->meta_descrption=$request->meta_description;
        }
        else
        {
            $brand->meta_descrption=$request->description;
        }

        $brand->save();

        return redirect()->route('admin.brands.index',['key='.$key.'&page='.$page])->with('success','Brand Added!');
    }

    public function show(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;
        Brnad::where('id',$id)->update([
            'is_active'=>$request->is_active
        ]);
        if($request->is_active)
        {
            return redirect()->route('admin.brands.index',['key='.$key.'&page='.$page])->with('success','Brand Active!');
        }
        else
        {
            return redirect()->route('admin.brands.index',['key='.$key.'&page='.$page])->with('error','Brand Deactive!');
        }
    }

    public function edit(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;
        $brnad=Brnad::where('id',$id)->first();
        return view('backend.products.brands.edit',compact('brnad','key','page'),['page_title'=>'Edit Brand']);
    }

    public function update(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;

        $brand=Brnad::find($id);
        $brand->name=$request->name;
        $brand->descrption=$request->description;
        $brand->icon=$request->icon;
        if($request->cat_id){
            $brand->cat_id=$request->cat_id;
            $brand->cat_img=$request->cat_img;
        }else{
            $brand->cat_id=[];
            $brand->cat_img=[];
        }
        if($request->meta_name)
        {
            $brand->meta_name=$request->meta_name;
        }
        else
        {
            $brand->meta_name=$request->name;
        }
        if($request->meta_description)
        {
            $brand->meta_descrption=$request->meta_description;
        }
        else
        {
            $brand->meta_descrption=$request->description;
        }

        $brand->save();

        return redirect()->route('admin.brands.index',['key='.$key.'&page='.$page])->with('success','Brand Updated!');
    }

    public function destroy(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;
        Brnad::where('id',$id)->delete();

        return redirect()->route('admin.brands.index',['key='.$key.'&page='.$page])->with('error','Brand Deleted!');
    }
}
