<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Commission;
use App\Models\Admin\Payout;
use App\Models\Admin\Reward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    public function frenchies_customer(Request $request){
        $search_key = $request->search_key;
        $search_date_range = $request->search_date_range;

        $customers = Customer::where('type','frenchies');

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
            return view('backend.frenchies_customers.table',compact('customers','search_key','search_date_range'));
        }

        return view('backend.frenchies_customers.index',compact('customers','search_key','search_date_range'),['page_title'=>'Customer List']);
    }

    public function updateVerificationStatus(Request $request)
    {
        $customer = Customer::findOrFail($request->id);
        $customer->verify_status = $request->status;
        if ($customer->save()) {
            return $customer->verify_status;
        }
        return 0;
    }

    public function payout($customer_id){
        $customer = Customer::find(decrypt($customer_id));
        $payouts = Payout::where('customer_id',decrypt($customer_id))->paginate(10);

        return view('backend.customers.payout',compact('payouts','customer'),['page_title'=>'Payout List']);
    }

    public function levelIncome($customer_id){
        $customer = Customer::find(decrypt($customer_id));
        $levels = [1,2,3,4,5,6,7,8,9,10];
        $commissions = commissions();
        $final_arr = [];
        foreach($levels as $key=>$level){
            $teams = Commission::where('user_id',decrypt($customer_id))->where('level',$level)->get();
            $total_team = $teams->count();
            $my_income = $teams->sum('commission');
            array_push($final_arr,['level'=>$level,'income'=>$commissions[$key],'total_team'=>$total_team,'my_income'=>$my_income]);
        }

        return view('backend.customers.level_income',compact('final_arr','customer'),['page_title'=>'Level Income']);
    }

    public function levelTeam($customer_id,$level){
        $customer = Customer::find(decrypt($customer_id));
        $teams = Commission::where('user_id',decrypt($customer_id))->with('order.customer')->where('level',$level)->get();
        return view('backend.customers.level_team',compact('teams','customer'));
    }

    public function customerRewardList($customer_id){
        $customer = Customer::find(decrypt($customer_id));
        $rewards = Reward::all();

        return view('backend.customers.reward',compact('customer','rewards'),['page_title'=>'Reward List']);
    }

    public function customer_login(Request $request,$id){
        Auth::guard('customer')->logout();
        $login_data = Customer::find(decrypt($id));
        auth()->guard('customer')->login($login_data, false);
        return redirect()->route('user_profile')->with('success', 'You Have Successfully Login !');

    }

    public function destroy($id)
    {
        Customer::where('id',$id)->delete();

        return back()->with('success','Customer Delete Successfully!');
    }

}
