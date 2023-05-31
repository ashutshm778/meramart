<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Attribute;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
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

        $list=Attribute::where(function ($query) use ($condition_category){
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
            return redirect()->route('admin.attributes.index',['key='.$search.'&search_category_id='.$search_category.'&page='.$page])->with('success', 'Attribute Deleted Successfully !!');
        }

        return view('backend.products.attributes.index',compact('list','search','search_category'),['page_title'=>'Attribute List']);
    }

    public function create(Request $request)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;
        return view('backend.products.attributes.create',compact('key','page','search_category'),['page_title'=>'Add Attribute']);
    }

    public function store(Request $request)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;

        $values = array();
        if($request->value[0] != null){
            foreach (json_decode($request->value[0]) as $keys => $value) {
                array_push($values, $value->value);
            }
        }

        $attribute=new Attribute;
        $attribute->name=$request->name;
        $attribute->category_id=$request->category_id;
        $attribute->value=$values;

        $attribute->save();

        return redirect()->route('admin.attributes.index',['key='.$key.'&search_category_id='.$search_category.'&page='.$page])->with('success','Attribute Added!');
    }

    public function show(Attribute $attribute)
    {
        //
    }

    public function edit(Request $request,Attribute $attribute)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;
        return view('backend.products.attributes.edit',compact('attribute','key','page','search_category'),['page_title'=>'Edit Attribute']);
    }

    public function update(Request $request, Attribute $attribute)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;

        $values = array();
        if($request->value[0] != null){
            foreach (json_decode($request->value[0]) as $keys => $value) {
                array_push($values, $value->value);
            }
        }

        $attribute=Attribute::find($attribute->id);
        $attribute->name=$request->name;
        $attribute->category_id=$request->category_id;
        $attribute->value=$values;

        $attribute->save();

        return redirect()->route('admin.attributes.index',['key='.$key.'&search_category_id='.$search_category.'&page='.$page])->with('success','Attribute Updated!');
    }

    public function destroy(Request $request,$id)
    {
        $key=$request->key;
        $search_category=$request->search_category_id;
        $page=$request->page;
        Attribute::where('id',$id)->delete();

        return redirect()->route('admin.attributes.index',['key='.$key.'&search_category_id='.$search_category.'&page='.$page])->with('error','Attribute Deleted!');
    }

    public function getAttributesByCategory($category_id)
    {
        $condition_category=[];
        $search_category=explode(',',$category_id);

        if(!empty($search_category))
        {
            foreach($search_category as $category)
            {
                array_push($condition_category,['category_id'=>$category]);
            }
            $list=Attribute::select('id','name')->where(function ($query) use ($condition_category){
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

    public function getAttributeValue($attribute_id)
    {
        return Attribute::whereIn('id',explode(',',$attribute_id))->get();
    }
}
