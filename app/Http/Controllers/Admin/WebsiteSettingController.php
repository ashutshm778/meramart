<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\WebsiteSetting;
use App\Http\Controllers\Controller;

class WebsiteSettingController extends Controller
{

    public function index(Request $request){
        $type=$request->type;
        $list=WebsiteSetting::where('type',$type)->paginate(10);

        return view('backend.website_setting.index',compact('list','type'),['page_title'=>ucfirst($type).' List']);
    }

    public function create(Request $request){
        $type=$request->type;

        return view('backend.website_setting.create',compact('type'),['page_title'=>'Add '.ucfirst($type)]);
    }

    public function store(Request $request){
        if($request->type == 'banner'){
            $check=WebsiteSetting::where('type','banner')->where('position',$request->position)->first();
            if($check){
                $website_setting=WebsiteSetting::find($check->id);
            }else{
                $website_setting=new WebsiteSetting;
            }
        }
        else{
            $website_setting=new WebsiteSetting;
        }
        $website_setting->type=$request->type;
        $website_setting->position=$request->position;
        $website_setting->image=$request->image;
        $website_setting->save();

        return redirect()->route('admin.website.setting.index',['type'=>$request->type])->with('success','Image Added Successfully!');
    }

    public function destroy($id){
        WebsiteSetting::where('id',$id)->delete();

        return redirect()->back()->with('error','Image Deleted Successfully!');
    }

    public function websiteSettingData(){
        return view('backend.website_setting.data',['page_title'=>'Manage Data']);
    }

    public function websiteSettingDataStore(Request $request){
        if($request->logo){
            WebsiteSetting::updateOrCreate([
                'type'=>'logo'
            ],[
                'image'=>$request->logo
            ]);
        }

        if($request->address){
            WebsiteSetting::updateOrCreate([
                'type'=>'address'
            ],
            [
                'image'=>$request->address
            ]);
        }

        if($request->footer_description){
            WebsiteSetting::updateOrCreate([
                'type'=>'footer_description'
            ],[
                'image'=>$request->footer_description
            ]);
        }

        if($request->email){
            $emails = array();
            if($request->email[0] != null){
                foreach (json_decode($request->email[0]) as $keys => $email) {
                    array_push($emails, $email->value);
                }
            }

            WebsiteSetting::updateOrCreate([
                'type'=>'email'
            ],[
                'image'=>implode(',',$emails)
            ]);
        }

        if($request->phone){
            $phones = array();
            if($request->phone[0] != null){
                foreach (json_decode($request->phone[0]) as $keys => $phone) {
                    array_push($phones, $phone->value);
                }
            }

            WebsiteSetting::updateOrCreate([
                'type'=>'phone'
            ],[
                'image'=>implode(',',$phones)
            ]);
        }

        if($request->delivery_cities){
            $delivery_city = array();
            if($request->delivery_cities[0] != null){
                foreach (json_decode($request->delivery_cities[0]) as $keys => $delivery_cities) {
                    array_push($delivery_city, $delivery_cities->value);
                }
            }

            WebsiteSetting::updateOrCreate([
                'type'=>'delivery_city'
            ],[
                'image'=>implode(',',$delivery_city)
            ]);
        }

        if($request->financial_months){
            WebsiteSetting::updateOrCreate([
                'type'=>'financial_month'
            ],[
                'image'=>$request->financial_months
            ]);
        }

        if($request->meta_title){
            WebsiteSetting::updateOrCreate([
                'type'=>'meta_title'
            ],[
                'image'=>$request->meta_title
            ]);
        }

        if($request->meta_keyword){
            $meta_keywords = array();
            if($request->meta_keyword[0] != null){
                foreach (json_decode($request->meta_keyword[0]) as $keys => $meta_keyword) {
                    array_push($meta_keywords, $meta_keyword->value);
                }
            }

            WebsiteSetting::updateOrCreate([
                'type'=>'meta_keyword'
            ],[
                'image'=>implode(',',$meta_keywords)
            ]);
        }

        if($request->meta_description){
            WebsiteSetting::updateOrCreate([
                'type'=>'meta_description'
            ],[
                'image'=>$request->meta_description
            ]);
        }


        return back()->with('success','Data Updated Successfully!');
    }

    public function adminIndex()
    {
        $financial_month = WebsiteSetting::where('type','financial_month')->first();
        return view('backend.website_setting.admin_setting',compact('financial_month'),['page_title'=>'Financial Month']);
    }
}
