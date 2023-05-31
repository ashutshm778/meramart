<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\FeatureActivation;

class FeatureActivationController extends Controller
{

    public function index(){
        return view('backend.setup_configuration.feature_activation.index',['page_title'=>'Feature Activation']);
    }

    public function store(Request $request){
        FeatureActivation::updateOrCreate([
            'feature_name'=>$request->feature
        ],[
            'is_active'=>$request->status
        ]);

        return 1;

    }

}
