<?php

namespace App\Http\Controllers\Api\sales_team;

use Auth;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AizUploadController;

class ProfileController extends Controller
{

    public function index(){
    $profile = User::select('id','name','email','phone','type')->where('id',Auth::user()->id)->with('userDetail:user_id,profile_image')->first();
    if($profile->userDetail->profile_image){
        $profile->userDetail->profile_image = asset('public/'.api_asset($profile->userDetail->profile_image));
    }else{
        $profile->userDetail->profile_image = '';
    }

    return $profile;
    }

}
