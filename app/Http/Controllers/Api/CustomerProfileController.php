<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerProfileController extends Controller
{

    public function profileCustomer(Request $request)
    {
        $customer = Customer::select('first_name','last_name','phone','email','photo')->where('id',Auth::user()->id)->first();
        if($customer->photo)
        {
            $customer->photo = asset('public/public/frontend/user_profile/'.$customer->photo);
        }

        return $customer;
    }

    public function customerSaveProfile(Request $request)
    {

        if ($request->hasFile('photo'))
        {
            $image = $request->file('photo');
            $name = rand().time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/public/frontend/user_profile');
            $image->move($destinationPath, $name);
            Customer::where('id',Auth::user()->id)->update([
                'photo'=>$name
            ]);
        }
        else
        {
            $this->validate($request, [
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'required|min:3|max:50',
                'email' => 'required|unique:customers,email,'.Auth::user()->id
            ]);

            Customer::where('id',Auth::user()->id)->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email
            ]);
        }

        $customer = Customer::select('first_name','last_name','phone','email','photo')->where('id',Auth::user()->id)->first();
        if($customer->photo)
        {
            $customer->photo = asset('public/public/frontend/user_profile/'.$customer->photo);
        }

        return $customer;
    }

}
