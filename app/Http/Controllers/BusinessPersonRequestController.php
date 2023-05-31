<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Admin\BusinessDetail;
use App\Models\BusinessPersonRequest;

class BusinessPersonRequestController extends Controller
{

    public function index(Request $request)
    {
        $search=$request->key;
        $type=$request->type;
        $list=BusinessPersonRequest::orderBy('id','desc');
        if($type == 'all')
        {
            $list=$list;
        }
        if($type == 'pending')
        {
            $list=$list->where('verify_status',0);
        }
        if($type == 'approved')
        {
            $list=$list->where('verify_status',1);
        }
        if($type == 'cancel')
        {
            $list=$list->where('verify_status',2);
        }
        if($search)
        {
            $list=$list->where(function ($query) use ($search){
                $query->where('phone',$search)
                      ->orWhere('email',$search)
                      ->orWhere('business_name',$search)
                      ->orWhere('owner_name',$search)
                      ->orWhere('gstin_number',$search);
            });
        }
        $list=$list->paginate(10);

        return view('backend.business_person_request.index',compact('list','search','type'),['page_title'=>ucfirst($type).' Business Person Request']);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(BusinessPersonRequest $businessPersonRequest)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $key=$request->key;
        $type=$request->type;
        $page=$request->page;

        $data=BusinessPersonRequest::find($id);

        return view('backend.business_person_request.edit',compact('data','key','type','page'),['page_title'=>ucfirst($type).' Business Person Request Detail']);
    }

    public function update(Request $request, $id)
    {
        $key=$request->key;
        $type=$request->search_type;
        $page=$request->page;

        $business_person_request=BusinessPersonRequest::where('id',$id)->first();

        $business_person_request->first_name=$request->first_name;
        $business_person_request->last_name=$request->last_name;
        $business_person_request->phone=$request->phone;
        $business_person_request->email=$request->email;
        $business_person_request->business_name=$request->business_name;
        $business_person_request->brand_name=$request->brand_name;
        $business_person_request->owner_name=$request->owner_name;
        $business_person_request->gstin_number=$request->gstin_number;
        $business_person_request->address=$request->address;
        $business_person_request->verify_status=$request->verify_status;

        if($request->file('gstin_document'))
        {
            $file= $request->file('gstin_document');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/gstin_documents'), $filename);
            $document_name=$filename;
            $business_person_request->gstin_document=$document_name;
        }
        else
        {
            $document_name=$business_person_request->gstin_document;
        }
        $business_person_request->save();

        if($request->verify_status == 1)
        {
            $customer=new Customer;
            $customer->first_name=$request->first_name;
            $customer->last_name=$request->last_name;
            $customer->phone=$request->phone;
            $customer->email=$request->email;
            $customer->type=strtolower($request->type);
            $customer->verify_status=1;
            $customer->save();

            BusinessDetail::create([
                'customer_id'=>$customer->id,
                'business_name'=>$request->business_name,
                'brand_name'=>$request->brand_name,
                'owner_name'=>$request->owner_name,
                'gst_number'=>$request->gstin_number,
                'gst_document'=>$document_name,
                'address'=>$request->address,
            ]);
        }

        return redirect()->route('admin.business.person.request.index',['key='.$key.'&type='.$type.'&page='.$page])->with('success','Request Updated Successfully!');
    }

    public function destroy(BusinessPersonRequest $businessPersonRequest)
    {
        //
    }

}
