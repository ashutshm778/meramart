<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.dashboard',['page_title'=>'Dashboard']);
    }

    public function admin_profile(Request $request){
        return view('backend.profile',['page_title'=>'Profile']);
    }

    public function admin_profile_update(Request $request){

        $user=User::find(Auth::user()->id);
        $user->name=$request->name;
        if(!empty($request->password)){
        $user->password=Hash::make($request->password);
        }
        $user->save();

        return back();
    }

    public function invoice_with_tax($id)
    {
        $order = Order::where('order_id',$id)->latest()->with('order_details.product')->first();
        return view('invoice.product_invoice_with_tax',compact('order'));
    }
    public function invoice_without_tax($id)
    {
        $order = Order::where('order_id',$id)->latest()->with('order_details.product')->first();
        return view('invoice.product_invoice_without_tax',compact('order'));
    }


}
