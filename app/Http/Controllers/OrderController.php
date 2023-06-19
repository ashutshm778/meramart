<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Commission;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\CustomerWallet;
use App\Models\CustomerAddress;
use App\Models\CommissionDirect;
use App\Models\CustomerOrderStatus;
use App\Models\RepurchaseCommission;

class OrderController extends Controller
{

    public function store(Request $request)
    {

        $user_id = Auth::guard('customer')->user()->id;
        $carts = Cart::where('user_id', $user_id)->get();

        if($carts->count() > 0){

        $order_id = Order::latest()->first();
        if ($order_id) {
            $order_id = $order_id->order_id + 1;
        } else {
            $order_id = 10001;
        }

        $mrp_prices = 0;
        $selling_prices = 0;
        $discounted_prices = 0;

        $order = new Order;

        $order->order_id = $order_id;
        $order->user_id = $user_id;
        $order->grand_total = $discounted_prices;
        $order->total_product_discount = $selling_prices - $discounted_prices;
        $order->coupon_discount = 0.00;
        $order->wallet_discount = 0.00;
        $order->shipping_address = CustomerAddress::where('id', $request->shipping_address_id)->with(['state', 'city'])->first();
        $order->payment_type = $request->payment_type;
        $order->payment_details = '';
        $order->payment_status = 'pending';
        $order->remark = '';

        if ($order->save()) {
            foreach ($carts as $cart) {
                $product = Product::where('id', $cart->product_id)->first();
                $product_price = homePrice($cart->product_id);
                if ($product) {
                    $mrp_prices = $mrp_prices + $product_price['p_p'];
                    $selling_prices = $selling_prices + $product_price['s_p'] * $cart->quantity;

                    if ($product_price['discount_type'] == 'percent') {
                        $discount_amount = ($product_price['s_p'] * $product_price['discount']) / 100;
                        $discounted_prices = $discounted_prices + ($product_price['s_p']  * $cart->quantity) - $discount_amount;
                    } elseif ($product_price['discount_type'] == 'amount') {
                        $discount_amount = $product_price['discount'];
                        $discounted_prices = $discounted_prices + ($product_price['s_p']   * $cart->quantity) - $discount_amount;
                    }
                    $order_details = new OrderDetail;

                    $order_details->order_id = $order->id;
                    $order_details->product_id = $cart->product_id;
                    $order_details->quantity = $cart->quantity;
                    $order_details->mrp_price = $product_price['s_p'];
                    $order_details->price = $product_price['s_p'] - $discount_amount;
                    $order_details->discounted_price = $discount_amount;
                    $order_details->tax = $product->tax_amount;
                    $order_details->shipping_cost = 0.00;

                    $order_details->save();

                    $order_status = new CustomerOrderStatus;
                    $order_status->order_id = $order->id;
                    $order_status->product_id = $cart->product_id;
                    $order_status->order_status = 'pending';
                    $order_status->save();

                    Cart::destroy($cart->id);
                }
            }

            Order::where('id', $order->id)->update([
                'grand_total' => $discounted_prices,
                'total_product_discount' => $selling_prices - $discounted_prices
            ]);
            $customer = Customer::find($user_id);
            $commission_data = commissions();
            $commission_repurchase_data = repurchase_commissions();

            if (empty($customer->referral_code)) {
                if (featureActivation('mlm') == '1' && !empty(Auth::guard('customer')->user()->refered_by)) {
                    if ($customer->orders->sum('grand_total') > 3999) {
                        $customer->verify_status = 1;
                        $customer->referral_code = 'MM' . rand(1111, 9999);
                        $customer->save();
                        $level = 10;
                        $referral_code = Auth::guard('customer')->user()->refered_by;
                        for ($i = 1; $i <= $level; $i++) {
                            $refferal_customer = Customer::where('referral_code', $referral_code)->first();

                            if (Customer::where('refered_by', $referral_code)->get()->count() == 2) {

                                if (CommissionDirect::where('user_id', $refferal_customer->id)->where('direct', 2)->get()->count() < 1) {

                                    $commission_direct = new CommissionDirect;
                                    $commission_direct->user_id = $refferal_customer->id;
                                    $commission_direct->commission = 600;
                                    $commission_direct->direct = 2;
                                    $commission_direct->save();


                                    $refferal_customer->balance = $refferal_customer->balance + $commission_direct->commission;
                                    $refferal_customer->save();

                                    $customer_wallet = new CustomerWallet;
                                    $customer_wallet->user_id = $refferal_customer->id;
                                    $customer_wallet->amount = $commission_direct->commission;
                                    $customer_wallet->transaction_type = 'credited';
                                    $customer_wallet->transaction_detail = 'Comission Credited For Two Direct';
                                    $customer_wallet->payment_details = '';
                                    $customer_wallet->balance = $refferal_customer->balance;
                                    $customer_wallet->approval = 0;
                                    $customer_wallet->save();
                                }
                            }

                            if (Customer::where('refered_by', $referral_code)->get()->count() == 10) {
                                if (CommissionDirect::where('user_id', $refferal_customer->id)->where('direct', 10)->get()->count() < 1) {

                                    $commission_direct = new CommissionDirect;
                                    $commission_direct->user_id = $refferal_customer->id;
                                    $commission_direct->commission = 2560;
                                    $commission_direct->direct = 10;
                                    $commission_direct->save();


                                    $refferal_customer->balance = $refferal_customer->balance + $commission_direct->commission;
                                    $refferal_customer->save();

                                    $customer_wallet = new CustomerWallet;
                                    $customer_wallet->user_id = $refferal_customer->id;
                                    $customer_wallet->amount = $commission_direct->commission;
                                    $customer_wallet->transaction_type = 'credited';
                                    $customer_wallet->transaction_detail = 'Comission Credited For Ten Direct';
                                    $customer_wallet->payment_details = '';
                                    $customer_wallet->balance = $refferal_customer->balance;
                                    $customer_wallet->approval = 0;
                                    $customer_wallet->save();
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
            if (!empty($customer->referral_code) && (Order::where('user_id',Auth::guard('customer')->user()->id)->get()->count() > 1)) {

                $customer->balance = $customer->balance + 300;
                $customer->save();

                $customer_wallet = new CustomerWallet;
                $customer_wallet->user_id = $customer->id;
                $customer_wallet->amount = 300;
                $customer_wallet->transaction_type = 'credited';
                $customer_wallet->transaction_detail = 'Repurchase Income Credited';
                $customer_wallet->payment_details = '';
                $customer_wallet->balance = $customer->balance;
                $customer_wallet->approval = 0;
                $customer_wallet->save();


                $level = 3;
                $referral_code = Auth::guard('customer')->user()->refered_by;
                for ($i = 1; $i <= $level; $i++) {
                    $refferal_customer = Customer::where('referral_code', $referral_code)->first();

                    if (!empty($refferal_customer->id)) {

                        $repurchase_commission = new RepurchaseCommission;
                        $repurchase_commission->user_id = $refferal_customer->id;
                        $repurchase_commission->order_id = $order->id;
                        $repurchase_commission->commission = $commission_repurchase_data[$i - 1];
                        $repurchase_commission->level = $i;
                        $repurchase_commission->save();


                        $refferal_customer->balance = $refferal_customer->balance + $repurchase_commission->commission;
                        $refferal_customer->save();

                        $customer_wallet = new CustomerWallet;
                        $customer_wallet->user_id = $refferal_customer->id;
                        $customer_wallet->amount = $repurchase_commission->commission;
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
      }else{
        return 0;
      }
    }

    public function check_rewards()
    {
        $customer=Auth::guard('customer')->user();
        if (!empty($customer->referral_code)) {
            $customer_data = Customer::where('refered_by', $customer->referral_code)->get();
            if ($customer_data->count() == 5) {
                $one_side = '';
                foreach ($customer_data as $customer_referral) {
                    $customer_referral_data = Customer::where('refered_by', $customer_referral->referral_code)->get();
                    if ($customer_referral_data->count() == 3) {
                        $one_side = $customer_referral_data->id;
                    }
                }
                $other_side = 0;
                $other_side_id = [];
                foreach ($customer_data->where('id', '!=', $one_side) as $customer_referral) {
                    if (!empty($one_side) && ($other_side < 2)) {
                        $customer_referral_data = Customer::where('refered_by', $customer_referral->referral_code)->get();
                        $other_side = $other_side + $customer_referral_data->count();
                        array_push($other_side_id, $customer_referral->id);
                    }
                }
                if($other_side >= 20){
                    return 'You are eligible for suter distributor';
                }else{
                    return 'You are not eligible for suter distributor';
                }
            }
        }
    }

}
