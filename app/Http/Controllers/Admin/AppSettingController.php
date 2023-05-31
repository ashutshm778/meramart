<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\AppSetting;
use App\Http\Controllers\Controller;

class AppSettingController extends Controller
{

    public function sliderIndex()
    {
        $list=AppSetting::where('type',request()->type)->paginate(10);

        return view('backend.app_setting.index',compact('list'),['page_title'=>ucfirst(request()->type).' List']);
    }

    public function sliderCreate()
    {
        return view('backend.app_setting.create',['page_title'=>'Add '.ucfirst(request()->type)]);
    }

    public function sliderStore(Request $request)
    {
        AppSetting::create([
            'type'=>$request->type,
            'image'=>$request->image,
            'link_type'=>$request->link_type,
            'link_id'=>$request->link_id
        ]);

        return redirect()->route('admin.slider.index','type=banner')->with('success','Image Added Successfully!');
    }

    public function sliderDestroy($id)
    {
        AppSetting::where('id',$id)->delete();

        return back()->with('error','Image Deleted Successfully!');
    }
}
