<?php

namespace App\Http\Controllers;

use Session;
use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Commission;
use App\Models\Admin\Brnad;
use App\Models\Admin\Offer;
use App\Models\Admin\Reward;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\CommissionDirect;
use Craftsys\Msg91\Facade\Msg91;
use App\Models\Admin\SubCategory;
use App\Models\Admin\SubSubCategory;
use App\Models\Admin\WebsiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BusinessPersonRequest;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'slug', 'name', 'icon')->where('is_active', 1)->orderBy('top_priority', 'asc')->take(6)->get();
        $featured_categories = Category::select('id', 'name')->where('is_active', 1)->where('is_feature', 1)->orderBy('priority', 'asc')->get();
        $new_arriavls = Product::where('is_active', 1)->where('is_new_arrival', 1)->take(8)->get();
        $features = Product::where('is_active', 1)->where('is_feature', 1)->take(8)->get();
        $best_sellers = Product::where('is_active', 1)->where('is_bestseller', 1)->take(8)->get();

        $sliders = WebsiteSetting::where('type', 'slider')->get();
        $top_banner = WebsiteSetting::where('type', 'banner')->where('position', 'top')->first();
        $mid_banner = WebsiteSetting::where('type', 'banner')->where('position', 'mid')->first();
        $bottom_banner = WebsiteSetting::where('type', 'banner')->where('position', 'bottom')->first();

        return view('frontend.index', compact('categories', 'new_arriavls', 'features', 'best_sellers', 'sliders', 'top_banner', 'mid_banner', 'bottom_banner', 'featured_categories'));
    }

    public function all_categories()
    {
        $categories = Category::select('id', 'slug', 'name', 'icon')->where('is_active', 1)->orderBy('priority', 'asc')->get();
        return view('frontend.all-categories', compact('categories'));
    }

    public function sub_categories(Request $request, $category_id)
    {
        $brand_id = $request->brand;
        $sub_categories = SubCategory::where('is_active', 1)->whereJsonContains('category_id', $category_id);
        if ($brand_id) {
            $products = Product::where('brand_id', $brand_id)->pluck('subcategory_id');
            $sub_cat_arr = [];
            foreach ($products as $product) {
                foreach ($product as $prod) {
                    array_push($sub_cat_arr, $prod);
                }
            }

            $sub_categories = $sub_categories->whereIn('id', $sub_cat_arr);
        }
        $sub_categories = $sub_categories->get();
        return view('frontend.sub-categories', compact('sub_categories', 'category_id', 'brand_id'));
    }

    public function attemptRegister(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'phone' => 'required|min:10|max:10|unique:customers,phone',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ]);

        Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'type' => 'retailer',
            'password' => Hash::make($request->password),
        ]);

        if (Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return redirect()->route('index')->with('success', 'You Have Successfully Register!');
        }
    }

    public function attemptRegisterMlm(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'phone' => 'required|min:10|max:10|unique:customers,phone',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
            'referral_code'=>'required',
        ]);

        Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'type' => 'retailer',
            'password' => Hash::make($request->password),
            'referral_code' =>'MM' . rand(1111, 9999),
            'refered_by' => $request->referral_code
        ]);

        if (Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return redirect()->route('index')->with('success', 'You Have Successfully Register!');
        }
    }
    public function businessPersonRequestSave(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'phone' => 'required|min:10|max:10',
            'type' => 'required|min:3|max:50',
            'business_name' => 'required|min:3|max:50',
        ]);

        $business_person_request = new BusinessPersonRequest;
        $business_person_request->first_name = $request->first_name;
        $business_person_request->last_name = $request->last_name;
        $business_person_request->phone = $request->phone;
        $business_person_request->type = $request->type;
        $business_person_request->business_name = $request->business_name;
        $business_person_request->save();


        return redirect()->route('business.person.request.details')->with('message', $business_person_request->id);
    }

    public function businessPersonRequestDetailSave(Request $request)
    {
        if ($request->file('gst_document')) {
            $file = $request->file('gst_document');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/gstin_documents'), $filename);
        }
        BusinessPersonRequest::where('id', $request->request_id)->update([
            'email' => $request->email,
            'brand_name' => $request->brand_name,
            'owner_name' => $request->owner_name,
            'gstin_number' => $request->gst_number,
            'gstin_document' => $filename,
            'address' => $request->address
        ]);

        return redirect()->route('index');
    }

    public function attemptLogin(Request $request)
    {
        $customer = Customer::where('phone', $request->phone)->orWhere('type', 'retailer')->orWhere('type', 'distributor')->orWhere('type', 'wholeseller')->first();
        if ($customer) {
            if (Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->remember)) {
                return redirect()->route('user_profile')->with('success', 'You Have Successfully Login !');
            }
        }

        return back()->with('error', 'Invalid Email or Password!');
    }

    public function attemptLogout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('index');
    }

    public function sendOtp(Request $request, $phone)
    {
        $data = Customer::where('phone', $phone)->first();
        if(empty($data)) {
            if($request->from == 'dealer'){
                $data = BusinessPersonRequest::where('phone', $phone)->first();
                if(empty($data)){
                    $phone = '91' . $phone;
                    if(env('APP_ENV') == 'local'){
                        $otp=1234;
                        Session::put('otp',$otp);
                        return 1;
                    }else{
                        $otp=rand(1111,9999);
                        Session::put('otp',$otp);
                          Msg91::sms()->to('91'.$request->phone)->flow('64a6b9d1d6fc057c15503ab2')->variable('business_name', 'Mera Mart User')->variable('otp', $otp)->send();
                        //Msg91::otp()->to($phone)->template('6114d04775025d197f1e0ad7')->send();
                        return 1;
                    }
                }else{
                    return 2;
                }
            }else{
                $phone = '91' . $phone;
                if(env('APP_ENV') == 'local'){
                    $otp=1234;
                    Session::put('otp',$otp);
                    return 1;
                }else{
                    $otp=rand(1111,9999);
                    Session::put('otp',$otp);
                      Msg91::sms()->to('91'.$request->phone)->flow('64a6b9d1d6fc057c15503ab2')->variable('business_name', 'Mera Mart User')->variable('otp', $otp)->send();
                    //Msg91::otp()->to($phone)->template('6114d04775025d197f1e0ad7')->send();
                    return 1;
                }
            }
        }else{
            return 3;
        }
    }

    public function sendForgotOtp(Request $request, $phone)
    {
        $data = Customer::where('phone', $phone)->first();
        if(!empty($data)){
        $otp=rand(1111,9999);
        Session::put('otp',$otp);
        Msg91::sms()->to('91'.$request->phone)->flow('64a6b9d1d6fc057c15503ab2')->variable('business_name', 'Mera Mart User')->variable('otp', $otp)->send();
        return 1;
       }else{
        return 2;
       }
    }

    public function verifyOtp($phone, $otp)
    {
        // $phone = '91' . $phone;
        // $ver = Msg91::otp((int)$otp)->to($phone)->verify();
        if(Session::get('otp') != $otp){
            return response()->json(['msg'=>'Wrong OTP!'], 401);
        }else{
            return 1;
        }
    }

    public function password_reset(Request $request){
        $customer=Customer::where('phone',$request->phone)->first();
        $customer->password=Hash::make($request->password);
        $customer->save();
        return back()->with('success', 'Your Password Reset Successfully!');
    }


    public function search(Request $request, $slug)
    {
        try {
            if ($request->type == 'category') {
                $cat_slug = Category::where('slug', $slug)->first();
                $category_id = $cat_slug->id;
                $sub_categories = SubCategory::where('is_active', 1)->whereJsonContains('category_id', '' . $cat_slug->id)->get();
                return view('frontend.sub-categories', compact('sub_categories', 'category_id'));
            }
            if ($request->type == 'subcategory') {
                $subcat_slug = SubCategory::where('slug', $slug)->first();
                $list = Product::whereJsonContains('subcategory_id', '' . $subcat_slug->id);
                if ($request->brand) {
                    $list = $list->where('brand_id', $request->brand);
                }
            }
            if ($request->type == 'subsubcategory') {
                $subsubcat_slug = SubSubCategory::where('slug', $slug)->first();
                $list = Product::whereJsonContains('subsubcategory_id', '' . $subsubcat_slug->id);
            }
            if ($request->type == 'product') {
                $data = Product::where('slug', $slug)->first();
                $product_attribut_array = [];
                if (is_array($data->attribute)) {
                    foreach ($data->attribute as $key => $attr) {
                        array_push($product_attribut_array, [$attr, $data->attribute_value[$key]]);
                    }
                }
                return view('frontend.product-details', compact('data', 'product_attribut_array'));
            }
            if ($request->type == 'brand') {
                $brand_id = Brnad::where('slug', $slug)->first();
                $category_ids = [];
                $lists = Product::where('brand_id', optional($brand_id)->id)->pluck('category_id');
                foreach ($lists as $datas) {
                    foreach ($datas as $da) {
                        array_push($category_ids, $da);
                    }
                }
                $categories = Category::select('id', 'slug', 'name', 'icon')->where('is_active', 1)->whereIn('id', array_values(array_unique($category_ids)))->orderBy('priority', 'asc')->get();
                return view('frontend.all-categories', compact('categories'));
            }

            $list = $list->orderBy('name', 'asc')->paginate(12);
            return vieW('frontend.product_list', compact('list', 'slug'));
        } catch (Exception $exception) {
            abort(404);
        }
    }

    public function updateUserProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email' => 'required|unique:customers,email,' . Auth::guard('customer')->user()->id
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = rand() . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/public/frontend/user_profile');
            $image->move($destinationPath, $name);
        } else {
            $name = Auth::guard('customer')->user()->photo;
        }
        Customer::where('id', Auth::guard('customer')->user()->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'photo' => $name,
            'address' => $request->address,
            'bank_account_name' => $request->bank_account_name,
            'branch' => $request->branch,
            'ifsc_code' => $request->ifsc_code,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'nominee_name' => $request->nominee_name,
            'nominee_relation' => $request->nominee_relation,
            'nominee_dob' => $request->nominee_dob,
        ]);

        return back()->with('success', 'Profile Updated Successfully!');
    }

    public function user_history_detail($id){
        $order = Order::where('id',$id)->first();
        return view('frontend.user-history-details', compact('order'));
    }

    public function user_direct_commission_list($id){
        $direct_commission_histories = CommissionDirect::where('order_id',$id)->where('direct_type',2)->get();
        return view('frontend.user-direct-comission-user-list', compact('direct_commission_histories'));
    }
    public function user_ten_direct_commission_list($id){
        $direct_commission_histories = CommissionDirect::where('order_id',$id)->where('direct_type',10)->get();
        return view('frontend.user-ten-direct-comission-user-list', compact('direct_commission_histories'));
    }
    public function user_reward(){
        $rewards = Reward::all();
        return view('frontend.user_reward',compact('rewards'));
    }
    public function tree_view(Request $request){
        if(!empty($request->referral_code)){
              $referral_code=$request->referral_code;
        }else{
            $referral_code=Auth::guard('customer')->user()->referral_code;
        }
        return view('frontend.tree_view',compact('referral_code'));
    }

    private function getChildren($referralCode)
    {
        return Customer::where('refered_by', $referralCode)->get();
    }
    public function referral_details(Request $request)
    {
        $total_pv=0;
        $data=Customer::where('referral_code', $request->referral_code)->first();
        if(!empty($data->id)){
        $order_data=Order::where('user_id', $data->id)->where('payment_status','success')->get();

        foreach($order_data as $datas){
         foreach($datas->order_details as $order_detail){
          $total_pv= $total_pv + ($order_detail->pv *  $order_detail->quantity);
          }
         }
        }
         $total_team=calculateTotalTeamCount($data);
         $total_team_pv=calculateTotalTeamPvCount($data);

        return 'Name: '.$data->first_name.' '.$data->last_name.'<br>User Id: '.$data->referral_code.' <br>Sponsor Id: '.$data->refered_by.' <br>Phone No: '.$data->phone.' <br>Total PV: '.$total_pv.' <br>Total Team: '.$total_team.' <br>Total Team PV: '.$total_team_pv;
    }

    private function buildTree($referralCode = null,$level = 1)
    {
        if ($level > 4) {
            return null; // Limit the depth to four levels
        }

        $node = Customer::where('referral_code', $referralCode)->first();
        if (!$node) {
            return null;
        }
        $children = $this->getChildren($referralCode);
        if (!$children->count()) {
            return [
                'v' => $node->referral_code,
                'f' =>'<div class=mytooltip><img src='.($node->verify_status == 1 ? ($node->photo ? asset('public/public/frontend/user_profile/'.$node->photo): asset('/public/green.png')) : ($node->photo ?asset('public/public/frontend/user_profile/'.$node->photo) : asset('/public/red.png'))).' style=height:50px;width:50px;><a
                href='.route('tree_view').'?referral_code='.$node->referral_code.'><span style=color:black>'.$node->referral_code.'</span><br><span
                     style=color:black>'.$node->name.'</span></a><span class=mytext id=my'.$node->referral_code.'></span></div>' ,
                'p' => $node->refered_by ?: null,
            ];
        }
        $tree = [
            'v' => $node->referral_code,
            'f' => '<div class=mytooltip><img src='.($node->verify_status == 1 ? ($node->photo ? asset('public/public/frontend/user_profile/'.$node->photo): asset('/public/green.png')): ( $node->photo ? asset('public/public/frontend/user_profile/'.$node->photo) : asset('/public/red.png'))).' style=height:50px;width:50px;><a
            href='.route('tree_view').'?referral_code='.$node->referral_code.'><span style=color:black>'.$node->referral_code.'</span><br><span
                 style=color:black>'.$node->name.'</span></a><span class=mytext id=my'.$node->referral_code.'></span></div>',
            'p' => $node->refered_by ?: null,
            'c' => [],
        ];
        foreach ($children as $child) {
            $tree['c'][] = $this->buildTree($child->referral_code,$level + 1);
        }
        return $tree;
    }

    // Function to get the MLM tree starting from the top-level member (John)
    public function getMLMTree(Request $request)
    {
        $topLevelReferralCode = $request->referral_code; // Change this to the referral code of your top-level member (e.g., 'John')
        $mlmTree = $this->buildTree($topLevelReferralCode);
        return response()->json($mlmTree);
    }



}
