<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{

    public function index(Request $request)
    {
        $search_country = $request->search_country;
        $search = $request->search;
        $states = State::orderBy('state','asc');

        if($search_country)
        {
            $states = $states->where('country_id',$search_country);
        }
        if($search)
        {
            $states = $states->where('state','like','%'.$search.'%');
        }

        $states = $states->paginate(10);

        return view('backend.address.state.index',compact('states','search','search_country'),['page_title'=>'State List']);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        State::updateOrCreate([
            'id'=>$request->id
        ],
        [
            'country_id'=>$request->country_id,
            'state'=>$request->state
        ]);

        return back()->with('success','State Submited Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $edit_data = State::find($id);
        $search_country = $request->search_country;
        $search = $request->search;
        $states = State::orderBy('state','asc');

        if($search_country)
        {
            $states = $states->where('country_id',$search_country);
        }
        if($search)
        {
            $states = $states->where('state','like','%'.$search.'%');
        }

        $states = $states->paginate(10);

        return view('backend.address.state.index',compact('states','search','search_country','edit_data'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request,$id)
    {
        $search=$request->search;
        $search_country = $request->search_country;
        $page=$request->page;
        State::destroy($id);

        return redirect()->route('admin.states.index',['search='.$search.'&search_country='.$search_country.'&page='.$page])->with('error','State Deleted!');
    }

    public function getStates($country_id)
    {
        return State::where('country_id',$country_id)->orderBy('state','asc')->get();
    }
}
