<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorController extends Controller
{

    public function index(Request $request)
    {
        $search=$request->key;
        $list=Vendor::orderBy('owner_name','asc');
        if($search)
        {
            $list=$list->where(function($query) use ($search){
                $query->where('owner_name', $search);
                $query->orWhere('contact_name', $search);
                $query->orWhere('phone',$search);
                $query->orWhere('email',$search);
                $query->orWhere('business_name',$search);
                $query->orWhere('gstin',$search);
                $query->orWhere('account_number',$search);
            });
        }
        $list=$list->paginate(10);

        return view('backend.vendor.index',compact('list','search'),['page_title'=>'Vendor List']);
    }

    public function create()
    {
        return view('backend.vendor.create',['page_title'=>'Add Vendor']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|unique:vendors,phone,NULL,id,deleted_at,NULL'
        ]);

        Vendor::create([
            'owner_name'=>$request->owner_name,
            'contact_name'=>$request->contact_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'business_name'=>$request->business_name,
            'gstin'=>$request->gstin,
            'address'=>$request->address,
            'account_holder_name'=>$request->account_holder_name,
            'account_number'=>$request->account_number,
            'ifsc_code'=>$request->ifsc_code,
            'branch_name'=>$request->branch_name,
        ]);

        return redirect()->route('admin.vendors.index')->with('success','Vendor Added Successfully!');
    }

    public function show(Vendor $vendor)
    {
        //
    }

    public function edit(Vendor $vendor)
    {
        return view('backend.vendor.edit',compact('vendor'),['page_title'=>'Edit Vendor']);
    }

    public function update(Request $request, Vendor $vendor)
    {
        $this->validate($request, [
            'phone' => 'required|unique:vendors,phone,'.$vendor->id.',id,deleted_at,NULL'
        ]);

        Vendor::where('id',$vendor->id)->update([
            'owner_name'=>$request->owner_name,
            'contact_name'=>$request->contact_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'business_name'=>$request->business_name,
            'gstin'=>$request->gstin,
            'address'=>$request->address,
            'account_holder_name'=>$request->account_holder_name,
            'account_number'=>$request->account_number,
            'ifsc_code'=>$request->ifsc_code,
            'branch_name'=>$request->branch_name,
        ]);

        return redirect()->route('vendors.index')->with('success','Vendor Added Successfully!');
    }

    public function destroy($id)
    {
        Vendor::where('id',$id)->delete();

        return redirect()->route('vendors.index')->with('error','Vendor Deleted Successfully!');
    }
}
