<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{

    public function index(Request $request)
    {
        $search_country = $request->search_country;
        $search_state = $request->search_state;
        $search = $request->search;
        $cities = City::orderBy('city','asc');

        if($search_country)
        {
            $cities = $cities->where('country_id',$search_country);
        }
        if($search_state)
        {
            $cities = $cities->where('state_id',$search_state);
        }
        if($search)
        {
            $cities = $cities->where('city','like','%'.$search.'%');
        }

        $cities = $cities->paginate(10);

        return view('backend.address.city.index',compact('cities','search','search_country','search_state'),['page_title'=>'City List']);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        City::updateOrCreate([
            'id'=>$request->id
        ],
        [
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'city'=>$request->city,
        ]);

        return back()->with('success','City Submited Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $edit_data = City::find($id);
        $search_country = $request->search_country;
        $search_state = $request->search_state;
        $search = $request->search;
        $cities = City::orderBy('city','asc');

        if($search_country)
        {
            $cities = $cities->where('country_id',$search_country);
        }
        if($search_state)
        {
            $cities = $cities->where('state_id',$search_state);
        }
        if($search)
        {
            $cities = $cities->where('city','like','%'.$search.'%');
        }

        $cities = $cities->paginate(10);

        return view('backend.address.city.index',compact('cities','search','search_country','search_state','edit_data'));
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
        $page=$request->page;
        City::destroy($id);

        return redirect()->route('admin.cities.index',['search='.$search.'&search_country='.$search_country.'&search_state='.$search_state.'&page='.$page])->with('error','City Deleted!');
    }

    public function getCities($state_id)
    {
        return City::where('state_id',$state_id)->orderBy('city','asc')->get();
    }
}
