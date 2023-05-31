<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Admin\AssignDealer;
use App\Http\Controllers\Controller;

class AssignDealerController extends Controller
{

    public function index()
    {
        $list=AssignDealer::orderBy('id','desc')->paginate();

        return view('backend.assign_dealer.index',compact('list'),['page_title'=>'Assign Dealer List']);
    }

    public function create()
    {
        $sales_members=User::where('type','sales_member')->get();

        return view('backend.assign_dealer.create',compact('sales_members'),['page_title'=>'Assign Dealer']);
    }

    public function store(Request $request)
    {
        $assigned_dealers=AssignDealer::where('sales_member_id',$request->sales_member)->pluck('dealer_id');
        $assign_dealsers=$request->assign_dealers;

        if($assign_dealsers)
        {
            foreach($assign_dealsers as $assign_dealser)
            {
                AssignDealer::updateOrCreate([
                    'sales_member_id'=>$request->sales_member,
                    'dealer_id'=>$assign_dealser
                ]);
            }
            $delete_dealers=array_diff($assigned_dealers->toArray(),$assign_dealsers);
            AssignDealer::whereIn('dealer_id',$delete_dealers)->delete();
        }
        else
        {
            $delete_dealers=$assigned_dealers;
            AssignDealer::whereIn('dealer_id',$delete_dealers)->delete();
        }

        return 1;

    }

    public function show(AssignDealer $assignDealer)
    {
        //
    }

    public function edit(AssignDealer $assignDealer)
    {
        //
    }

    public function update(Request $request, AssignDealer $assignDealer)
    {
        //
    }

    public function destroy(AssignDealer $assignDealer)
    {
        //
    }

    public function getDealersList($sales_member_id)
    {
        $dealers=Customer::where('type','!=','retailer')->where('verify_status',1)->pluck('id');
        $assign_dealers=AssignDealer::where('sales_member_id','!=',$sales_member_id)->pluck('dealer_id');

        if(count($assign_dealers) != 0)
        {
            $final_dealers=array_diff($dealers->toArray(),$assign_dealers->toArray());
        }
        else
        {
            $final_dealers=$dealers;
        }
        return view('backend.assign_dealer.dealers_list',compact('final_dealers','sales_member_id'));

    }
}
