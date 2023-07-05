<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Admin\Payout;
use Illuminate\Http\Request;
use App\Models\CustomerWallet;
use App\Http\Controllers\Controller;

class PayoutController extends Controller
{

    public function index(){
        $customers = Customer::where('balance','!=',0)->paginate(10);

        return view('backend.payout.index',compact('customers'),['page_title'=>'Payout List']);
    }

    public function store(Request $request){
        $customer = Customer::find($request->customer_id);
        if($customer){
            if($customer->balance >= $request->amount){
                $payout = new Payout;
                $payout->customer_id = $customer->id;
                $payout->amount = $request->amount;
                $payout->payment_type = 'cash';
                $payout->save();

                $customer->balance = $customer->balance - $request->amount;
                $customer->payout = $customer->payout + $request->amount;
                $customer->save();

                $customer_wallet = new CustomerWallet;
                $customer_wallet->user_id = $customer->id;
                $customer_wallet->amount = $request->amount;
                $customer_wallet->transaction_type = 'debit';
                $customer_wallet->transaction_detail = 'Payout Debited';
                $customer_wallet->balance = $customer->balance;
                $customer_wallet->approval = 0;
                $customer_wallet->save();

                return back()->with('success','Payout Successfully!');
            }else{
                return back()->with('error','Payout Amount Not be greater then balance!');
            }
        }else{
            return back()->with('error','Customer Not Found!');
        }
    }

}
