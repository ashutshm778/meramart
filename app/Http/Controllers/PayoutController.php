<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Admin\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{

    public function index(){
        $payouts = Payout::where('customer_id',Auth::guard('customer')->user()->id)->orderBy('id','desc')->get();

        return view('frontend.user.payout.index',compact('payouts'));
    }

}
