<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Reward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RewardController extends Controller
{

    public function index(){
        $rewards = Reward::all();

        return view('backend.reward.index',compact('rewards'),['page_title'=>'Reward List']);
    }

    public function create(){
        return view('backend.reward.create',['page_title'=>'Add Reward']);
    }

    public function store(Request $request){
        $reward = new Reward;
        $reward->name = $request->name;
        $reward->total_id = $request->total_id;
        $reward->one_side_id = $request->one_side_id;
        $reward->other_side_id = $request->other_side_id;
        $reward->product_name = $request->product_name;
        $reward->amount = $request->amount;
        $reward->save();

        return redirect()->route('admin.reward.index')->with('success','Reward Added Successfully!');
    }

    public function edit($id){
        $reward = Reward::find(decrypt($id));

        return view('backend.reward.edit',compact('reward'),['page_title'=>'Edit Reward']);
    }

    public function update(Request $request,$id){
        $reward = Reward::find(decrypt($id));
        $reward->name = $request->name;
        $reward->total_id = $request->total_id;
        $reward->one_side_id = $request->one_side_id;
        $reward->other_side_id = $request->other_side_id;
        $reward->product_name = $request->product_name;
        $reward->amount = $request->amount;
        $reward->save();

        return redirect()->route('admin.reward.index')->with('success','Reward Updated Successfully!');
    }

}
