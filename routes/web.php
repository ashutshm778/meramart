<?php

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AizUploadController;
use App\Http\Controllers\RepurchaseController;
use App\Http\Controllers\LevelIncomeController;
use App\Http\Controllers\Admin\PincodeController;
use App\Http\Controllers\CustomerAddressController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin',function(){
    return redirect()->route('login');
});

Route::view('about-us', 'frontend.about-us')->name('about');
Route::view('contact-us', 'frontend.contact-us')->name('contact');
Route::view('privacypolicy', 'frontend.privacy_policy')->name('privacy');
Route::view('terms', 'frontend.term')->name('term');


Route::group(['middleware' => 'auth:customer'], function () {

    Route::view('user-profile', 'frontend.user-profile')->name('user_profile');
    Route::post('add-to-cart',[CartController::class,'store'])->name('add.to.cart');
    Route::get('delete-to-cart/{cart_id}',[CartController::class,'destroy'])->name('delete.to.cart');
    Route::get('change-cart-qty/{product_id}/{qty}',[CartController::class,'changeCartQty'])->name('change.cart.qty');
    Route::view('checkout', 'frontend.checkout')->name('checkout');
    Route::view('cart', 'frontend.cart')->name('cart');
    Route::view('track-order', 'frontend.track-order')->name('track_order');
    Route::view('wishlist', 'frontend.wishlist')->name('wishlist');
    Route::view('user-history', 'frontend.user-history')->name('user_history');
    Route::get('user-history-details/{id}', [FrontController::class, 'user_history_detail'])->name('user_history_details');
    Route::view('user-wallet', 'frontend.user-wallet')->name('user_wallet');
    Route::view('user-commission', 'frontend.user-comission')->name('user_commission');
    Route::view('user-referral', 'frontend.user-referral')->name('user_referral');
    Route::view('user-dashboard', 'frontend.user-dashboard')->name('user_dashboard');
    Route::view('user-direct-commission', 'frontend.user-direct-comission')->name('user_direct_commission');
    Route::get('user-direct-commission-user-list/{id}',[FrontController::class,'user_direct_commission_list'])->name('user_direct_commission_list');
    Route::view('user-ten-direct-commission', 'frontend.user-ten-direct-comission')->name('user_ten_direct_commission');
    Route::get('user-ten-direct-commission-user-list/{id}',[FrontController::class,'user_ten_direct_commission_list'])->name('user_ten_direct_commission_list');
    Route::get('user-reward',[FrontController::class,'user_reward'])->name('user_reward');
    Route::post('update-user-profile',[FrontController::class, 'updateUserProfile'])->name('update.user.profile');
    Route::view('manage-address','frontend.manage_address')->name('manage.address');
    Route::get('get-address-by-pincode/{pincode}',[PincodeController::class,'getAddressByPincode'])->name('get.address.by.pincode');
    Route::post('store-customer-address',[CustomerAddressController::class,'store'])->name('store.customer.address');
    Route::get('delete-customer-address/{id}',[CustomerAddressController::class,'destroy'])->name('delete.customer.address');
    Route::post('customer-store-order',[OrderController::class,'store'])->name('customer.store.order');
    Route::get('order-summary',function(){
        $order = Order::where('user_id',Auth::guard('customer')->user()->id)->latest()->with('order_details.product')->first();
        return view('frontend.order_thankyou_page',compact('order'));
    })->name('order.summary');

    Route::get('customer-order-list',function(){
        $orders = Order::where('user_id',Auth::guard('customer')->user()->id)->with('order_details.product')->get();
        return view('frontend.order_list',compact('orders'));
    })->name('customer.order.list');

    Route::post('add-to-wishlist',[WishlistController::class,'store'])->name('add.to.wishlist');
    Route::post('delete-to-wishlist',[WishlistController::class,'delete'])->name('delete.to.wishlist');

    Route::get('check_reward',[OrderController::class,'check_reward'])->name('check_reward');

    //Payout
    Route::get('received-amount',[PayoutController::class,'index'])->name('payout.amount');

    //Repurchase Commission
    Route::get('repurchase-commission-list',[RepurchaseController::class,'index'])->name('repurchse.commission.list');

    //Level Income
    Route::get('level-income-index',[LevelIncomeController::class,'index'])->name('level.income.index');
    Route::get('level-team-list/{level}',[LevelIncomeController::class,'teamList'])->name('level.team.list');


    Route::get('tree-view', [FrontController::class, 'tree_view'])->name('tree_view');

    Route::get('/mlm-tree', [FrontController::class, 'getMLMTree'])->name('mlm_tree');

    Route::get('/referral_details', [FrontController::class, 'referral_details'])->name('referral_details');

});


//Retailer Register
if(featureActivation('retailer') == '1'){
    Route::view('user-register', 'frontend.auth.register')->name('user.register');
    Route::post('customer-register', [FrontController::class, 'attemptRegister'])->name('customer.register');
}
if(featureActivation('mlm') == '1'){
    Route::view('user-register-mlm', 'frontend.auth.register_mlm')->name('user.register.mlm');
    Route::post('customer-register-mlm', [FrontController::class, 'attemptRegisterMlm'])->name('customer.register_mlm');
}
Route::get('send-otp/{phone}', [FrontController::class, 'sendOtp'])->name('send.otp');
Route::get('verify-otp/{phone}/{otp}', [FrontController::class, 'verifyOtp'])->name('verify.otp');

Route::get('send-forgot-otp/{phone}', [FrontController::class, 'sendForgotOtp'])->name('send.forgototp');
Route::post('password/reset', [FrontController::class, 'password_reset'])->name('customer.password_reset');

//Business Person Register
if(featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1'){
    Route::view('business-person-request-form', 'frontend.auth.business_person_request_form')->name('business.person.request.form');
    Route::post('business-person-request-save', [FrontController::class, 'businessPersonRequestSave'])->name('business.person.request.save');
    Route::view('business-person-request-details', 'frontend.auth.business_person_request_details')->name('business.person.request.details');
    Route::post('business-person-request-details-save', [FrontController::class, 'businessPersonRequestDetailSave'])->name('business.person.request.details.save');
}

//Login
if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1' || featureActivation('mlm') == '1'){
    Route::view('user-login', 'frontend.auth.login')->name('user.login');
    Route::post('customer-login', [FrontController::class, 'attemptLogin'])->name('customer.login');
}

//Forgot Password
Route::view('forgot-password', 'frontend.auth.forgot-password')->name('customer.forgot_password');

//Message After Business Person Register
Route::view('massege', 'frontend.auth.massege')->name('customer.massege');

//Logout
Route::get('customer-logout', [FrontController::class, 'attemptLogout'])->name('customer.logout');

//Index
Route::get('/', [FrontController::class, 'index'])->name('index');

//Search
Route::get('search',[SearchController::class,'productSearch'])->name('product-search');
Route::post('product-fillter',[SearchController::class,'productFillter'])->name('product.fillter');

//Categories
Route::get('categories', [FrontController::class, 'all_categories'])->name('categories');
Route::get('sub-categories/{category_id}', [FrontController::class, 'sub_categories'])->name('sub.categories');
Route::get('/{slug}', [FrontController::class, 'search'])->name('search');


//Product Detail
// Route::get('product-detail/{slug}', [ProductController::class,'productDetail'])->name('product.detail');
Route::get('modal-product-detail/{id}', [ProductController::class,'modalProductDetail'])->name('modal.product.detail');
Route::get('product/variant_price', [ProductController::class,'get_varinat_price'])->name('product.get_varinat_price');
Route::get('product/variant_price_data', [ProductController::class,'get_variant_price_data'])->name('product.get_varinat_price_data');
Route::get('product/get_selected_variant', [ProductController::class,'get_selected_variant'])->name('product.get_selected_variant');

//About

//  Route::get("/sub-categories", function(){
//     return view("frontend.sub-categories");
//  })->name('sub-categories');

Route::view('blog', 'frontend.blog')->name('blog');
Route::view('blog-details', 'frontend.blog-details')->name('blog_details');
Route::view('term-and-condition', 'frontend.term-and-condition')->name('term_and_condition');
Route::view('privacy-policy', 'frontend.privacy-policy')->name('privacy_policy');






Route::view('user-invoice', 'frontend.user-invoice')->name('user_invoice');

// Upload multiple Images
Route::post('/aiz-uploader', [AizUploadController::class, 'show_uploader']);
Route::post('/aiz-uploader/upload', [AizUploadController::class, 'upload']);
Route::get('/aiz-uploader/get_uploaded_files', [AizUploadController::class, 'get_uploaded_files']);
Route::delete('/aiz-uploader/destroy/{id}', [AizUploadController::class, 'destroy']);
Route::post('/aiz-uploader/get_file_by_ids', [AizUploadController::class, 'get_preview_files']);
Route::get('/aiz-uploader/download/{id}', [AizUploadController::class, 'attachment_download'])->name('download_attachment');
