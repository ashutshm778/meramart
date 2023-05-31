<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AizUploadController;

class ImageUploadController extends Controller
{

    public function uploadProfileImage(Request $request){
        $request->request->add(['type' => 'api']);
        $aiz_controller = new AizUploadController;
        $image_data = $aiz_controller->upload($request);
        Customer::where('id',Auth::user()->id)->update([
            'photo'=>$image_data->id
        ]);

        return response()->json(['image'=>asset('public/'.api_asset($image_data->id))]);
    }

}
