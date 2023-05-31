<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $list=Category::orderBy('priority','asc');
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
            return redirect()->route('admin.categories.index',['key='.$search.'&page='.$page])->with('success', 'Category Deleted Successfully !!');
        }

        if($request->prio)
        {
            return redirect()->route('admin.categories.index',['key='.$search.'&page='.$page])->with('success', 'Priority Updated Successfully !!');
        }
        else
        {
            return view('backend.products.categories.index',compact('list','search'),['page_title'=>'Category List']);
        }

    }

    public function create(Request $request)
    {
        $key=$request->key;
        $page=$request->page;
        return view('backend.products.categories.create',compact('key','page'),['page_title'=>'Add Category']);
    }

    public function store(Request $request)
    {
        $key=$request->key;
        $page=$request->page;

        $priority=Category::orderBy('priority','desc')->first();
        if($priority)
        {
            $priority_number=$priority->priority+1;
        }
        else
        {
            $priority_number=1;
        }
        $category=new Category;
        $category->slug=strtolower(str_replace(" ","-",$request->name)).'-'.$priority_number;
        $category->name=$request->name;
        $category->descrption=$request->description;
        $category->commision=$request->commision;
        $category->icon=$request->icon;
        $category->banner=$request->banner;
        if($request->meta_name)
        {
            $category->meta_name=$request->meta_name;
        }
        else
        {
            $category->meta_name=$request->name;
        }
        if($request->meta_description)
        {
            $category->meta_descrption=$request->meta_description;
        }
        else
        {
            $category->meta_descrption=$request->description;
        }
        $category->priority=$priority_number;
        $category->nav_priority=$priority_number;
        $category->top_priority=$priority_number;
        $category->bottom_priority=$priority_number;

        $category->save();

        return redirect()->route('admin.categories.index',['key='.$key.'&page='.$page])->with('success','Category Added!');
    }

    public function show(Request $request,Category $category)
    {
        $key=$request->key;
        $page=$request->page;
        Category::where('id',$category->id)->update([
            'is_active'=>$request->is_active
        ]);
        if($request->is_active)
        {
            return redirect()->route('admin.categories.index',['key='.$key.'&page='.$page])->with('success','Category Active!');
        }
        else
        {
            return redirect()->route('admin.categories.index',['key='.$key.'&page='.$page])->with('error','Category Deactive!');
        }
    }

    public function edit(Request $request,Category $category)
    {
        $key=$request->key;
        $page=$request->page;
        return view('backend.products.categories.edit',compact('category','key','page'),['page_title'=>'Edit Category']);
    }

    public function update(Request $request, Category $category)
    {
        $key=$request->key;
        $page=$request->page;

        $category=Category::find($category->id);

        $category->name=$request->name;
        $category->descrption=$request->description;
        $category->commision=$request->commision;
        $category->icon=$request->icon;
        $category->banner=$request->banner;
        if($request->meta_name)
        {
            $category->meta_name=$request->meta_name;
        }
        else
        {
            $category->meta_name=$request->name;
        }
        if($request->meta_description)
        {
            $category->meta_descrption=$request->meta_description;
        }
        else
        {
            $category->meta_descrption=$request->description;
        }

        $category->save();

        return redirect()->route('admin.categories.index',['key='.$key.'&page='.$page])->with('success','Category Updated!');
    }

    public function destroy(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;
        Category::where('id',$id)->delete();

        return redirect()->route('admin.categories.index',['key='.$key.'&page='.$page])->with('error','Category Deleted!');
    }

    public function priority(Request $request)
    {
        $new_value=Category::where('id',$request->id)->first();
        $old_value=Category::where('priority',$request->value)->first();
        if($old_value)
        {
            Category::where('id',$request->id)->update([
                'priority'=>$request->value
            ]);
            Category::where('id',$old_value->id)->update([
                'priority'=>$new_value->priority
            ]);

            return 1;
        }
        else
        {
            return 2;
        }
    }

    public function feature(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;
        Category::where('id',$id)->update([
            'is_feature'=>$request->is_feature
        ]);
        if($request->is_feature)
        {
            return redirect()->route('admin.categories.index',['key='.$key.'&page='.$page])->with('success','Category Featured!');
        }
        else
        {
            return redirect()->route('admin.categories.index',['key='.$key.'&page='.$page])->with('error','Category Not Featured!');
        }
    }

    public function categorywisePriorty($drag_id,$replace_id,$type)
    {
        if($type == 'nav')
        {
            $priority = 'nav_priority';
        }
        if($type == 'top')
        {
            $priority = 'top_priority';
        }
        if($type == 'bottom')
        {
            $priority = 'bottom_priority';
        }

        $da=Category::where($priority,$drag_id)->first();
        $re=Category::where($priority,$replace_id)->first();
       // return [$drag_id,$replace_id,$da,$re,$type,$priority];

        $da_navp=$da->$priority;
        $re_navp=$re->$priority;
        // Category::where('id',$da->id)->update([$priority=>$re->priority]);
        // Category::where('id',$re->id)->update([$priority=>$da->priority]);
        // return [$da,$re];

         $da->$priority=$re_navp;
         $da->save();

         $re->$priority=$da_navp;
         $re->save();


        $list=Category::orderBy($priority,'asc')->get();

        return view('backend.products.categories.table',compact('list','type','priority'));
    }

    public function categoryPriortyData($type)
    {
        if($type == 'nav')
        {
            $priority = 'nav_priority';
        }
        if($type == 'top')
        {
            $priority = 'top_priority';
        }
        if($type == 'bottom')
        {
            $priority = 'bottom_priority';
        }
        $list=Category::orderBy($priority,'asc')->get();
        return view('backend.products.categories.table',compact('list','type','priority'));
    }
}
