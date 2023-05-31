<?php

namespace App\Http\Controllers\Api;

use Auth;
use Carbon\Carbon;
use App\Models\DealerOrder;
use Illuminate\Http\Request;
use App\Models\Admin\AssignTarget;
use App\Models\DealerOrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DealerOrderResource;
use App\Http\Resources\Api\DealerOrderRequestResource;

class SalesTeamDashboardController extends Controller
{

    public function salesTeamDashboard(){
        $month = Carbon::now()->format('F');
        $year = Carbon::now()->format('Y');
        $targets = AssignTarget::where('sales_member_id',Auth::user()->id)->where('month',$month)->where('year',$year)->first(['target_amount','achive_target_amount']);
        $orders = DealerOrder::where('sales_member_id',Auth::user()->id)->with(['dealer'])->orderBy('id','desc')->where('created_at', '>=', Carbon::now()->subDays(7))->get();
        $order_requests = DealerOrderRequest::where('sales_member_id',Auth::user()->id)->with(['dealer'])->orderBy('id','desc')->whereDate('created_at', Carbon::today())->groupBy('order_request_id')->get();

        return response()->json([
            'orders'=>DealerOrderResource::collection($orders),
            'order_requests'=>DealerOrderRequestResource::collection($order_requests),
            'targets'=>$targets
        ]);
    }

}
