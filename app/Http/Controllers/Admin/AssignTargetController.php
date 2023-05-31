<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Models\Admin\AssignTarget;
use App\Http\Controllers\Controller;
use App\Models\Admin\WebsiteSetting;

class AssignTargetController extends Controller
{

    public function index($sales_member_id)
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

            return view('backend.assign_target.index',compact('financial_years','sales_member_id'));
        }
        else
        {
            return back()->with('error','Add Financial Year First.');
        }
    }

    public function store(Request $request)
    {
        foreach($request->month as $key=>$month)
        {
            AssignTarget::updateOrCreate([
                'added_by'=>Auth::user()->id,
                'sales_member_id'=>$request->sales_member_id,
                'month'=>$month,
                'year'=>$request->year[$key]
            ],
            [
                'target_amount'=>$request->target_amount[$key],
                'achive_target_amount'=>$request->achive_target_amount[$key],
            ]);
        }

        return redirect()->route('admin.assign.target.index',$request->sales_member_id)->with('success','Target Assign Successfully!');
    }
}
