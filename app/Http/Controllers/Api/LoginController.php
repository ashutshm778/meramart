<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Craftsys\Msg91\Facade\Msg91;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function businessPersonLogin(Request $request)
    {
        $data=Customer::where('type','!=','retailer')->where('phone',$request->phone)->first();

        if($data)
        {
            $data->access_token =  $data->createToken('MyApp')->plainTextToken;
            return $data;
        }
        else
        {
            return response()->json(['msg'=>'User Not Exists!'],401);
        }

    }

    public function businessMemberLogin(Request $request)
    {
        $data=User::where('type','sales_member')->where('phone',$request->phone)->first();
        if($data)
        {
            $password=Hash::check($request->password, $data->password);
            if($password)
            {
                $data->access_token =  $data->createToken('MyApp')->plainTextToken;
                return $data;
            }
            else
            {
                return response()->json(['msg'=>'Password Not Matched!'],401);
            }
        }
        else
        {
            return response()->json(['msg'=>'User Not Exists!'],401);
        }
    }

    public function customerCheck(Request $request)
    {

        $data=Customer::where('phone',$request->phone)->first();
        if(empty($data))
        {
            $phone='91'.$request->phone;
            Msg91::otp()->to($phone)->template('6114d04775025d197f1e0ad7')->send();
            return response()->json(['msg'=>'OTP Send Successfully!']);
        }
        else
        {
            return response()->json(['msg'=>'User Already Exists!'],401);
        }
    }

    public function verifyOtp(Request $request)
    {
        try
        {
            $phone='91'.$request->phone;
            $ver= Msg91::otp((int)$request->otp)->to($phone)->verify();
            $this->validate($request, [
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'required|min:3|max:50',
                'phone' => 'required|min:10|max:10|unique:customers,phone',
                'password' => 'min:6|required'
            ]);

            Customer::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'phone'=>$request->phone,
                'type'=>'retailer',
                'password'=>Hash::make($request->password),
                'status'=>1,
            ]);

            $data=Customer::where('phone',$request->phone)->first();
            $data->access_token =  $data->createToken('MyApp')->plainTextToken;
            return $data;
        }
        catch(Exception $exception)
        {
            return response()->json(['msg'=>'Wrong OTP!'],401);
        }
    }

    public function customerLogin(Request $request)
    {
        $data=Customer::where('type','retailer')->where('phone',$request->phone)->first();
        if($data)
        {
            $password=Hash::check($request->password, $data->password);
            if($password)
            {
                $data->access_token =  $data->createToken('MyApp')->plainTextToken;
                return $data;
            }
            else
            {
                return response()->json(['msg'=>'Password Not Matched!'],401);
            }
        }
        else
        {
            return response()->json(['msg'=>'User Not Exists!'],401);
        }
    }

}
