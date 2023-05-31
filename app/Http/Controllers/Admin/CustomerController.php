<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    public function index(Request $request){
        $search_key = $request->search_key;
        $search_date_range = $request->search_date_range;

        $customers = Customer::where('type','retailer');

        if($search_date_range){
            $dates=explode('-',$search_date_range);
            $d1=strtotime($dates[0]);
            $d2=strtotime($dates[1]);
            $da1=date('Y-m-d',$d1);
            $da2=date('Y-m-d',$d2);
            $startDate = Carbon::createFromFormat('Y-m-d', $da1)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $da2)->endOfDay();

            $search_date_range=$dates[0].'-'.$dates[1];
            $customers = $customers->whereBetween('created_at', [$startDate, $endDate]);
        }
        if($search_key){
            $customers = $customers->where(function($query) use ($search_key){
                $query->where('first_name','like','%'.$search_key.'%')
                ->orWhere('phone',$search_key)
                ->orWhere('email','like','%'.$search_key.'%');
            });
        }

        $customers = $customers->orderBy('created_at','desc')->paginate(10);

        if($request->ajax()){
            return view('backend.customers.table',compact('customers','search_key','search_date_range'));
        }

        return view('backend.customers.index',compact('customers','search_key','search_date_range'),['page_title'=>'Customer List']);
    }

}
