<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\UserDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\ExperienceDetail;
use App\Models\Admin\QualificationDetail;

class SalesTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=User::where('type','sales_member')->paginate(10);
        return view('backend.sales_team.index',compact('list'),['page_title'=>'Sales Team List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sales_team.create',['page_title'=>'Add Sales Team']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|same:confirm-password'
        ]);
        if($request->email)
        {
            $this->validate($request, [
                'email' => 'email|unique:users,email'
            ]);
        }

        if($request->middle_name)
        {
            $name=$request->first_name.' '.$request->middle_name.' '.$request->last_name;
        }
        else
        {
            $name=$request->first_name.' '.$request->last_name;
        }
        $user=User::create([
            'name'=>$name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'type'=>'sales_member',
            'password'=>Hash::make($request->password)
        ]);

        UserDetail::create([
            'user_id'=>$user->id,
            'first_name'=>$request->first_name,
            'middle_name'=>$request->middle_name,
            'last_name'=>$request->last_name,
            'dob'=>$request->dob,
            'gender'=>$request->gender,
            'adhar_number'=>$request->adhar_number,
            'adhar_front_image'=>$request->adhar_front_image,
            'adhar_back_image'=>$request->adhar_back_image,
            'pan_number'=>$request->pan_number,
            'pan_image'=>$request->pan_image,
            'profile_image'=>$request->profile_image,
            'marital_status'=>$request->marital_status,
            'address'=>$request->address
        ]);

        if($request->qualification)
        {
            foreach($request->qualification as $key=>$qualification)
            {
                QualificationDetail::create([
                    'user_id'=>$user->id,
                    'qualification'=>$request->qualification[$key],
                    'university'=>$request->university[$key],
                    'institute_name'=>$request->institute_name[$key],
                    'year_of_passing'=>$request->year_of_passing[$key],
                    'percentage'=>$request->percentage[$key],
                    'marks_memo'=>$request->marks_memo[$key],
                ]);
            }
        }

        if($request->institute_name_exp)
        {
            foreach($request->institute_name_exp as $keys=>$experience)
            {
                ExperienceDetail::create([
                    'user_id'=>$user->id,
                    'institute_name'=>$request->institute_name_exp[$keys],
                    'designation'=>$request->designation[$keys],
                    'from_date'=>$request->from_date[$keys],
                    'to_date'=>$request->to_date[$keys],
                    'Year_of_exp'=>$request->Year_of_exp[$keys],
                    'starting_salary'=>$request->starting_salary[$keys],
                    'ending_salary'=>$request->ending_salary[$keys],
                    'attachment'=>$request->attachment[$keys],
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->with(['userDetail','qualification','experience'])->first();

        return view('backend.sales_team.edit',compact('user'),['page_title'=>'Edit Sales Team']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
