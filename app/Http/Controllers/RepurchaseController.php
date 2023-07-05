<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\RepurchaseCommission;

class RepurchaseController extends Controller
{

    public function index(){
        $commissions = RepurchaseCommission::where('user_id',Auth::guard('customer')->user()->id)->get();

        return view('frontend.user.repurchase.index',compact('commissions'));
    }

}
