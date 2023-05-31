<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\WebsiteSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\AssignDealerTarget;

class AssignDealerTargetController extends Controller
{
    public function index($dealer_id)
    {
        $months = [
            'January'=>1,
            'February'=>2,
            'March'=>3,
            'April'=>4,
            'May'=>5,
            'June'=>6,
            'July'=>7,
            'August'=>8,
            'September'=>9,
            'October'=>10,
            'November'=>11,
            'December'=>12
        ];
        $financial_month = WebsiteSetting::where('type','financial_month')->first();
        if($financial_month)
        {
            $date = date('Y')."-".$months[$financial_month->image]."-01";
            $financial_years = [];
            for($i=0;$i<=11;$i++)
            {
                array_push($financial_years,date('Y-m-d', strtotime($date. ' + '.$i.'months')));
            }

            return view('backend.assign_dealer_target.index',compact('financial_years','dealer_id'));
        }
        else
        {
            return back()->with('error','Add Financial Year First.');
        }
    }

    public function store(Request $request)
    {
        //return $request->all();
        foreach($request->month as $key=>$month)
        {
            AssignDealerTarget::updateOrCreate([
                'added_by'=>Auth::user()->id,
                'dealer_id'=>$request->dealer_id,
                'month'=>$month,
                'year'=>$request->year[$key]
            ],
            [
                'target_amount'=>$request->target_amount[$key],
                'achive_target_amount'=>$request->achive_target_amount[$key],
            ]);
        }

        return redirect()->route('admin.assign.dealer.target.index',$request->dealer_id)->with('success','Target Assign Successfully!');
    }
}
