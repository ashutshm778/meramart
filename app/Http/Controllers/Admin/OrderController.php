<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Commission;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\CustomerWallet;
use App\Models\CommissionDirect;
use App\Http\Controllers\Controller;
use App\Models\RepurchaseCommission;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::withCount('order_details')->orderBy('id', 'desc')->paginate(10);

        return view('backend.order.index', compact('orders'), ['page_title' => 'Order List']);
    }

    public function detail($order_id)
    {
        $order = Order::where('order_id', $order_id)->with(['order_details', 'customer'])->first();

        return view('backend.order.detail', compact('order'), ['page_title' => 'Order Details']);
    }

    public function productStatus(Request $request)
    {

        if (!is_array($request->product_id)) {
            $product_ids = explode(',', $request->product_id);
        } else {
            $product_ids = $request->product_id;
        }
        foreach ($product_ids as $product_id) {
            OrderDetail::where('order_id', $request->order_id)->where('product_id', $product_id)->update([
                'order_status' => $request->status
            ]);
        }

        Order::where('id', $request->order_id)->update([
            'order_status' => $request->status
        ]);
    }

    public function paymentStatus(Request $request)
    {

        $order = Order::find($request->id);
        $order->payment_status = $request->payment_status;
        $order->remark = $request->remark;
        $order->save();



        $customer = Customer::find($order->user_id);
        $commission_data = commissions();
        $commission_repurchase_data = repurchase_commissions();


        $order_data=Order::where('user_id', $order->user_id)->where('payment_status','success')->get();
        $total_pv=0;
        foreach($order_data as $data){
            foreach($data->order_details as $order_detail){
                 $total_pv= $total_pv + ($order_detail->pv *  $order_detail->quantity);
             }
        }
        $customer->total_pv= $total_pv;
        $customer->pv= $total_pv/40;
        $customer->group_pv=$customer->group_pv+ $total_pv/40;
        $customer->save();
        if($customer->verify_status==0){
            if ($customer->orders->sum('grand_total') > 990) {
                $customer->verify_status = 1;
                $customer->save();
            }
        }

        $gv=$customer->group_pv;
        if(!empty($customer->referral_code)){

                $referral_code = $customer->refered_by;
                do {
                    $refferal_customer = Customer::where('referral_code', $referral_code)->first();
                    $refferal_customer->group_pv = $refferal_customer->group_pv + $gv;
                    $refferal_customer->save();

                    $referral_code = $refferal_customer->refered_by;
                  } while (!empty(Customer::where('referral_code', $referral_code)->first()));

        }



        if (!empty($customer->referral_code)) {

            if (featureActivation('mlm') == '1' && !empty($customer->refered_by)) {

                if ($total_pv > 39) {

                    $level = 10;
                    $referral_code = $customer->refered_by;
                    for ($i = 1; $i <= $level; $i++) {
                        $refferal_customer = Customer::where('referral_code', $referral_code)->first();
                        if(!empty($refferal_customer->id)){
                            if (Customer::where('refered_by', $referral_code)->where('verify_status', 1)->where('total_pv','>',39)->get()->count() % 2 == 0) {

                                $all_user_ids = Customer::where('refered_by', $referral_code)->where('verify_status', 1)->where('total_pv','>',39)->get()->pluck('id')->toArray();
                                $all_commission_direct_user_id = CommissionDirect::where('user_id', $refferal_customer->id)->where('direct_type', 2)->get()->pluck('direct_user_id')->toArray();

                                $diff = array_diff($all_user_ids, $all_commission_direct_user_id);

                                foreach ($diff as $userId) {

                                    $commission_direct = new CommissionDirect;
                                    $commission_direct->user_id = $refferal_customer->id;
                                    $commission_direct->order_id = $order->id;
                                    $commission_direct->commission = 300;
                                    $commission_direct->direct_type = 2;
                                    $commission_direct->direct_user_id = $userId;
                                    $commission_direct->save();

                                    $refferal_customer->balance = $refferal_customer->balance + 300;
                                    $refferal_customer->save();

                                    $customer_wallet = new CustomerWallet;
                                    $customer_wallet->user_id = $refferal_customer->id;
                                    $customer_wallet->amount = 300;
                                    $customer_wallet->transaction_type = 'credited';
                                    $customer_wallet->transaction_detail = 'Comission Credited For Two Direct';
                                    $customer_wallet->payment_details = '';
                                    $customer_wallet->balance = $refferal_customer->balance;
                                    $customer_wallet->approval = 0;
                                    $customer_wallet->save();
                                }

                            }

                            if (Customer::where('refered_by', $referral_code)->get()->where('verify_status', 1)->where('total_pv','>',39)->count() % 10 == 0) {


                                $all_user_ids = Customer::where('refered_by', $referral_code)->where('verify_status', 1)->where('total_pv','>',39)->get()->pluck('id')->toArray();
                                $all_commission_direct_user_id = CommissionDirect::where('user_id', $refferal_customer->id)->where('direct_type', 10)->get()->pluck('direct_user_id')->toArray();

                                $diff = array_diff($all_user_ids, $all_commission_direct_user_id);

                                foreach ($diff as $userId) {

                                    $commission_direct = new CommissionDirect;
                                    $commission_direct->user_id = $refferal_customer->id;
                                    $commission_direct->order_id = $order->id;
                                    $commission_direct->commission = 250;
                                    $commission_direct->direct_type = 10;
                                    $commission_direct->direct_user_id = $userId;
                                    $commission_direct->save();

                                    $refferal_customer->balance = $refferal_customer->balance + 250;
                                    $refferal_customer->save();

                                    $customer_wallet = new CustomerWallet;
                                    $customer_wallet->user_id = $refferal_customer->id;
                                    $customer_wallet->amount = 250;
                                    $customer_wallet->transaction_type = 'credited';
                                    $customer_wallet->transaction_detail = 'Comission Credited For Ten Direct';
                                    $customer_wallet->payment_details = '';
                                    $customer_wallet->balance = $refferal_customer->balance;
                                    $customer_wallet->approval = 0;
                                    $customer_wallet->save();
                                }

                            }
                      }

                        if (!empty($refferal_customer->id)) {
                            $commission = new Commission;
                            $commission->user_id = $refferal_customer->id;
                            $commission->order_id = $order->id;
                            $commission->commission = $commission_data[$i - 1];
                            $commission->level = $i;
                            $commission->save();


                            $refferal_customer->balance = $refferal_customer->balance + $commission->commission;
                            $refferal_customer->save();

                            $customer_wallet = new CustomerWallet;
                            $customer_wallet->user_id = $refferal_customer->id;
                            $customer_wallet->amount = $commission->commission;
                            $customer_wallet->transaction_type = 'credited';
                            $customer_wallet->transaction_detail = 'Level Income Credited';
                            $customer_wallet->payment_details = '';
                            $customer_wallet->balance = $refferal_customer->balance;
                            $customer_wallet->approval = 0;
                            $customer_wallet->save();

                            $referral_code = $refferal_customer->refered_by;
                        }
                    }
                }
            }
        }

            if($customer->team_repurchase_status==1){
                if (!empty($customer->referral_code) && ($total_pv > 40)) {

                    $amount_comission_data=($order->grand_total*7.5)/100;
                    $customer->balance = $customer->balance + $amount_comission_data;
                    $customer->save();

                    $customer_wallet = new CustomerWallet;
                    $customer_wallet->user_id = $customer->id;
                    $customer_wallet->amount = $amount_comission_data;
                    $customer_wallet->transaction_type = 'credited';
                    $customer_wallet->transaction_detail = 'Repurchase Income Credited';
                    $customer_wallet->payment_details = '';
                    $customer_wallet->balance = $customer->balance;
                    $customer_wallet->approval = 0;
                    $customer_wallet->save();


                    // $referral_code = $customer->refered_by;
                    // do {
                    //     $refferal_customer = Customer::where('referral_code', $referral_code)->first();
                    //     $refferal_customer->pv = $refferal_customer->pv + 1;
                    //     $refferal_customer->save();

                    //     $referral_code = $refferal_customer->refered_by;
                    // } while (!empty(Customer::where('referral_code', $referral_code)->first()));


                    $level = 5;
                    $referral_code = $customer->refered_by;
                    for ($i = 1; $i <= $level; $i++) {
                        $refferal_customer = Customer::where('referral_code', $referral_code)->first();

                        if (!empty($refferal_customer->id)) {
                            $comission_amount_repurchase=($order->grand_total * $commission_repurchase_data[$i - 1])/100;
                            $repurchase_commission = new RepurchaseCommission;
                            $repurchase_commission->user_id = $refferal_customer->id;
                            $repurchase_commission->order_id = $order->id;
                            $repurchase_commission->commission = $comission_amount_repurchase;
                            $repurchase_commission->level = $i;
                            $repurchase_commission->save();


                            $refferal_customer->balance = $refferal_customer->balance +$comission_amount_repurchase;
                            $refferal_customer->save();

                            $customer_wallet = new CustomerWallet;
                            $customer_wallet->user_id = $refferal_customer->id;
                            $customer_wallet->amount = $comission_amount_repurchase;
                            $customer_wallet->transaction_type = 'credited';
                            $customer_wallet->transaction_detail = 'Repurchase Level Income Credited';
                            $customer_wallet->payment_details = '';
                            $customer_wallet->balance = $refferal_customer->balance;
                            $customer_wallet->approval = 0;
                            $customer_wallet->save();

                            $referral_code = $refferal_customer->refered_by;
                        }
                    }
                }
            }

            if($customer->team_repurchase_status==0){
                if (!empty($customer->referral_code) && ($total_pv > 40)) {
                    $repurchase_amount=($total_pv-40)*150;
                    $amount_comission_data=($repurchase_amount*7.5)/100;
                    $customer->balance = $customer->balance + $amount_comission_data;
                    $customer->team_repurchase_status=1;
                    $customer->save();

                    $customer_wallet = new CustomerWallet;
                    $customer_wallet->user_id = $customer->id;
                    $customer_wallet->amount = $amount_comission_data;
                    $customer_wallet->transaction_type = 'credited';
                    $customer_wallet->transaction_detail = 'Repurchase Income Credited';
                    $customer_wallet->payment_details = '';
                    $customer_wallet->balance = $customer->balance;
                    $customer_wallet->approval = 0;
                    $customer_wallet->save();


                    // $referral_code = $customer->refered_by;
                    // do {
                    //     $refferal_customer = Customer::where('referral_code', $referral_code)->first();
                    //     $refferal_customer->pv = $refferal_customer->pv + 1;
                    //     $refferal_customer->save();

                    //     $referral_code = $refferal_customer->refered_by;
                    // } while (!empty(Customer::where('referral_code', $referral_code)->first()));


                    $level = 5;
                    $referral_code = $customer->refered_by;
                    for ($i = 1; $i <= $level; $i++) {
                        $refferal_customer = Customer::where('referral_code', $referral_code)->first();

                        if (!empty($refferal_customer->id)) {
                            $comission_amount_repurchase=($repurchase_amount * $commission_repurchase_data[$i - 1])/100;
                            $repurchase_commission = new RepurchaseCommission;
                            $repurchase_commission->user_id = $refferal_customer->id;
                            $repurchase_commission->order_id = $order->id;
                            $repurchase_commission->commission = $comission_amount_repurchase;
                            $repurchase_commission->level = $i;
                            $repurchase_commission->save();


                            $refferal_customer->balance = $refferal_customer->balance +$comission_amount_repurchase;
                            $refferal_customer->save();

                            $customer_wallet = new CustomerWallet;
                            $customer_wallet->user_id = $refferal_customer->id;
                            $customer_wallet->amount = $comission_amount_repurchase;
                            $customer_wallet->transaction_type = 'credited';
                            $customer_wallet->transaction_detail = 'Repurchase Level Income Credited';
                            $customer_wallet->payment_details = '';
                            $customer_wallet->balance = $refferal_customer->balance;
                            $customer_wallet->approval = 0;
                            $customer_wallet->save();

                            $referral_code = $refferal_customer->refered_by;
                        }
                    }
                }
            }


        return redirect()->back();
    }
}
