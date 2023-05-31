<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{

    public function index(Request $request)
    {
        $list=Color::orderBy('name','asc');
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
            return redirect()->route('admin.colors.index',['key='.$search.'&page='.$page])->with('success', 'Color Deleted Successfully !!');
        }

        return view('backend.products.colors.index',compact('list','search'),['page_title'=>'Color List']);
    }

    public function create(Request $request)
    {
        $key=$request->key;
        $page=$request->page;
        return view('backend.products.colors.create',compact('key','page'),['page_title'=>'Add Color']);
    }

    public function store(Request $request)
    {
        $key=$request->key;
        $page=$request->page;

        $color=new Color;
        $color->name=$request->name;
        $color->code=$request->code;

        $color->save();

        return redirect()->route('admin.colors.index',['key='.$key.'&page='.$page])->with('success','Color Added!');
    }

    public function show(Color $color)
    {
        //
    }

    public function edit(Request $request,Color $color)
    {
        $key=$request->key;
        $page=$request->page;
        return view('backend.products.colors.edit',compact('color','key','page'),['page_title'=>'Edit Color']);
    }

    public function update(Request $request, Color $color)
    {
        $key=$request->key;
        $page=$request->page;

        $color=Color::find($color->id);
        $color->name=$request->name;
        $color->code=$request->code;

        $color->save();

        return redirect()->route('admin.colors.index',['key='.$key.'&page='.$page])->with('success','Color Updated!');
    }

    public function destroy(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;
        Color::where('id',$id)->delete();

        return redirect()->route('admin.colors.index',['key='.$key.'&page='.$page])->with('error','Color Deleted!');
    }
}
