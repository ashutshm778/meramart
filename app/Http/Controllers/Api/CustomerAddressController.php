<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Models\Admin\Pincode;
use App\Models\CustomerAddress;
use App\Http\Controllers\Controller;

class CustomerAddressController extends Controller
{

    public function customerGetAddress(Request $request)
    {
        $addresses = CustomerAddress::where('user_id',Auth::user()->id)->with(['state','city'])->get();

        return response()->json([
            'addresses'=>$addresses
        ]);
    }

    public function getAddressByPincode(Request $request)
    {
        $pincode = Pincode::where('pincode',$request->pincode)->with(['country','state','city'])->first();
        if($pincode)
        {
            return $pincode;
        }
        else
        {
            return response(['msg'=>'There is no such pincode!'],400);
        }
    }

    public function storeUpdate(Request $request)
    {
        $address = CustomerAddress::updateOrCreate([
            'id'=>$request->id
        ],
        [
            'user_id'=>Auth::user()->id,
            'name'=>$request->name,
            'country'=>$request->country,
            'state'=>$request->state_id,
            'city'=>$request->city_id,
            'pincode'=>$request->pincode,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'address_type'=>$request->address_type
        ]);
        $addresses = CustomerAddress::where('id',$address->id)->with(['state','city'])->get();

        return response()->json([
            'address'=>$addresses
        ]);
    }

    public function customerDeleteAddress(Request $request)
    {
        CustomerAddress::destroy($request->address_id);

        return response()->json([
            'msg'=>'Address Deleted Successfully!'
        ]);
    }

}
