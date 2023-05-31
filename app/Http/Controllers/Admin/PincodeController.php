<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Pincode;
use App\Http\Controllers\Controller;

class PincodeController extends Controller
{

    public function index(Request $request)
    {
        $search_country = $request->search_country;
        $search_state = $request->search_state;
        $search_city = $request->search_city;
        $search = $request->search;
        $pincodes = Pincode::orderBy('pincode','asc');

        if($search_country)
        {
            $pincodes = $pincodes->where('country_id',$search_country);
        }
        if($search_state)
        {
            $pincodes = $pincodes->where('state_id',$search_state);
        }
        if($search_city)
        {
            $pincodes = $pincodes->where('city_id',$search_city);
        }
        if($search)
        {
            $pincodes = $pincodes->where('pincode','like','%'.$search.'%');
        }

        $pincodes = $pincodes->paginate(10);

        return view('backend.address.pincode.index',compact('pincodes','search','search_country','search_state','search_city'),['page_title'=>'Pincode List']);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Pincode::updateOrCreate([
            'id'=>$request->id
        ],
        [
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'city_id'=>$request->city_id,
            'pincode'=>$request->pincode
        ]);

        return back()->with('success','Pincode Submited Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $edit_data = Pincode::find($id);
        $search_country = $request->search_country;
        $search_state = $request->search_state;
        $search_city = $request->search_city;
        $search = $request->search;
        $pincodes = Pincode::orderBy('pincode','asc');

        if($search_country)
        {
            $pincodes = $pincodes->where('country_id',$search_country);
        }
        if($search_state)
        {
            $pincodes = $pincodes->where('state_id',$search_state);
        }
        if($search_city)
        {
            $pincodes = $pincodes->where('city_id',$search_city);
        }
        if($search)
        {
            $pincodes = $pincodes->where('pincode','like','%'.$search.'%');
        }

        $pincodes = $pincodes->paginate(10);

        return view('backend.address.pincode.index',compact('pincodes','search','search_country','search_state','search_city','edit_data'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request,$id)
    {
        $search=$request->search;
        $search_country = $request->search_country;
        $search_state = $request->search_state;
        $search_city = $request->search_city;
        $page=$request->page;
        Pincode::destroy($id);

        return redirect()->route('admin.pincodes.index',['search='.$search.'&search_country='.$search_country.'&search_state='.$search_state.'&search_city='.$search_city.'&page='.$page])->with('error','Pincode Deleted!');
    }

    public function getAddressByPincode($pincode)
    {
        return Pincode::where('pincode',$pincode)->with(['country','state','city'])->first();
    }
}
