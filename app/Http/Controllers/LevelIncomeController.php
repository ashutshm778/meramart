<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Order;
use App\Models\Commission;
use Illuminate\Http\Request;

class LevelIncomeController extends Controller
{

    public function index(){
        $levels = [1,2,3,4,5,6,7,8,9,10];
        $commissions = commissions();
        $final_arr = [];
        foreach($levels as $key=>$level){
            $teams = Commission::where('user_id',Auth::guard('customer')->user()->id)->where('level',$level)->get();

            $total_pv_all=0;
            foreach($teams as $team){
             $order_data=Order::where('user_id', $team->order->user_id)->where('payment_status','success')->get();
             $total_pv=0;
             foreach($order_data as $data){
              foreach($data->order_details as $order_detail){
               $total_pv= $total_pv + ($order_detail->pv *  $order_detail->quantity);
               }
              }
              $total_pv_all=$total_pv_all+$total_pv;
             }

            $total_team = $teams->count();
            $my_income = $teams->sum('commission');
            array_push($final_arr,['level'=>$level,'income'=>$commissions[$key],'total_team'=>$total_team,'my_income'=>$my_income,'total_pv_all'=>$total_pv_all]);
        }

        return view('frontend.user.level_income.index',compact('final_arr'));
    }

    public function teamList($level){
        $teams = Commission::where('user_id',Auth::guard('customer')->user()->id)->with('order.customer')->where('level',$level)->get();
        return view('frontend.user.level_income.team',compact('teams'));
    }

    public function user_under_forty_pv(){
        $teams=[];
        return view('frontend.user.level_income.user_under_fourty_pv',compact('teams'));
    }
    }

}
