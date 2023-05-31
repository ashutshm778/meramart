<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Admin\City;
use App\Models\Admin\State;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;

class CustomerAddressController extends Controller
{

    public function store(Request $request)
    {
        CustomerAddress::updateOrCreate([
                'id'=>$request->id
            ],
            [
                'user_id'=>Auth::guard('customer')->user()->id,
                'name'=>$request->name,
                'country'=>$request->country,
                'state'=>State::where('state',$request->state)->first()->id,
                'city'=>City::where('city',$request->city)->first()->id,
                'pincode'=>$request->pincode,
                'phone'=>$request->phone,
                'address'=>$request->address
            ]);

        if($request->id)
        {
            return back()->with('success','Address Updated Successfully!');
        }
        else
        {
            return back()->with('success','Address Added Successfully!');
        }
    }

    public function destroy($id)
    {
        CustomerAddress::destroy($id);

        return back()->with('error','Address Deleted Successfully!');
    }

}
