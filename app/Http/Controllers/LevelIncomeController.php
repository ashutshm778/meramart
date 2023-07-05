<?php

namespace App\Http\Controllers;

use Auth;
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
            $total_team = $teams->count();
            $my_income = $teams->sum('commission');
            array_push($final_arr,['level'=>$level,'income'=>$commissions[$key],'total_team'=>$total_team,'my_income'=>$my_income]);
        }

        return view('frontend.user.level_income.index',compact('final_arr'));
    }

    public function teamList($level){
        $teams = Commission::where('user_id',Auth::guard('customer')->user()->id)->with('order.customer')->where('level',$level)->get();
        return view('frontend.user.level_income.team',compact('teams'));
    }

}
