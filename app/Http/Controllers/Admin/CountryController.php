<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Country;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;
        $countries = Country::orderBy('country','asc');

        if($search)
        {
            $countries = $countries->where('country','like','%'.$search.'%');
        }

        $countries = $countries->paginate(10);

        return view('backend.address.country.index',compact('countries','search'),['page_title'=>'Country List']);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Country::updateOrCreate([
            'id'=>$request->id
        ],
        [
            'country'=>$request->country
        ]);

        return back()->with('success','Country Submited Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $edit_data = Country::find($id);
        $search = $request->search;
        $countries = Country::orderBy('country','asc');

        if($search)
        {
            $countries = $countries->where('country','like','%'.$search.'%');
        }

        $countries = $countries->paginate(10);

        return view('backend.address.country.index',compact('countries','search','edit_data'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request,$id)
    {
        $search=$request->search;
        $page=$request->page;
        Country::destroy($id);

        return redirect()->route('admin.countries.index',['search='.$search.'&page='.$page])->with('error','Country Deleted!');
    }
}
