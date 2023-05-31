<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{

    public function index(Request $request){
        $search_key = $request->search_key;
        $units = Unit::orderBy('name','asc')->paginate(10);

        return view('backend.products.unit.index',compact('units','search_key'),['page_title'=>'Units']);
    }

    public function store(Request $request){
        if($request->id){
            $unit = Unit::find($request->id);
        }else{
            $unit = new Unit;
        }
        $unit->name = $request->name;
        $unit->save();

        return redirect()->route('admin.units.index')->with('success','Unit Saved Successfully!');
    }

    public function edit(Request $request,$id){
        $search_key = $request->search_key;
        $edit_data = Unit::find($id);
        $units = Unit::orderBy('name','asc')->paginate(10);

        return view('backend.products.unit.index',compact('units','search_key','edit_data'),['page_title'=>'Units']);
    }

    public function destroy($id){
        $unit = Unit::destroy($id);

        return redirect()->route('admin.units.index')->with('success','Unit Deleted Successfully!');
    }

}
