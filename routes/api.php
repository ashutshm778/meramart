<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\DealerCartController;
use App\Http\Controllers\Api\DealerOrderController;
use App\Http\Controllers\Api\ImageUploadController;
use App\Http\Controllers\Api\ProductDetailController;
use App\Http\Controllers\Api\SearchProductController;
use App\Http\Controllers\Api\SalesTeamOrderController;
use App\Http\Controllers\Api\CustomerAddressController;
use App\Http\Controllers\Api\CustomerProfileController;
use App\Http\Controllers\Api\SalesTeamDashboardController;
use App\Http\Controllers\Api\SalesTeamOrderRequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ******************************   Start Sales Team App Api  ****************************** //

    Route::prefix("sales-team")->group(function(){

        //Login
        Route::post('login',[LoginController::class,'businessMemberLogin']);

        Route::middleware('auth:sanctum')->group( function () {

            //Dashboard
            Route::get('dashboard',[SalesTeamDashboardController::class,'salesTeamDashboard']);

            //Product List
            Route::post('product-list',[ProductController::class,'productList']);

            //Product Detail
            Route::post('product-detail',[ProductController::class,'productDetail']);

            //Add To Cart
            Route::post('add-update-dealer-cart',[DealerCartController::class,'addUpdateDealerCart']);

            //Delete To Cart
            Route::delete('delete-cart-product',[DealerCartController::class,'deleteCartProduct']);

            //Dealer List From Cart
            Route::post('cart-dealer-list',[DealerCartController::class,'cartDealerList']);

            //Dealer Product List
            Route::post('cart-dealer-product-list',[DealerCartController::class,'cartDealerProductList']);

            //Dealer Order Request
            Route::post('dealer-order-request',[DealerOrderController::class,'dealerOrderRequest']);

            //Dealer List
            Route::post('distributor-list',[HomeController::class,'salesMemberDistributorList']);

            //Order Request List
            Route::get('order-request-list',[SalesTeamOrderRequestController::class,'salesTeamOrderRequestList']);
            Route::get('order-request-detail/{order_request_id}',[SalesTeamOrderRequestController::class,'salesTeamOrderRequestDetail']);

            //Order List
            Route::get('order-list',[SalesTeamOrderController::class,'salesTeamOrderList']);

            //Order Detail
            Route::get('order-detail/{order_id}',[SalesTeamOrderController::class,'orderDetail']);

            //Profile
            Route::get('profile',[App\Http\Controllers\Api\sales_team\ProfileController::class,'index']);

            //Image Profile Upload
            Route::post('upload-profile-image',[ImageUploadController::class,'uploadProfileImage']);

        });

    });

// ******************************   End Sales Team App Api  ****************************** //



// ******************************   Start Customer App Api  ****************************** //

    Route::prefix("customer")->group(function(){


        //Registration
        Route::post('check-phone',[LoginController::class,'customerCheck']);
        Route::post('verify-otp',[LoginController::class,'verifyOtp']);

        //Login
        Route::post('login',[LoginController::class,'customerLogin']);

        Route::middleware('auth:sanctum')->group( function () {

            //Home
            Route::post('home',[HomeController::class,'customerHome']);

            //Get Category
            Route::post('get-category',[HomeController::class,'getCategory']);

            //Get SubCategory
            Route::post('get-sub-category',[HomeController::class,'getSubCategory']);

            //Product
            Route::post('product-list',[ProductController::class,'customerProductList']);
            Route::post('product-search',[SearchProductController::class,'customerProductSearch']);
            Route::post('product-detail',[ProductDetailController::class,'customerProductDetail']);

            //Cart
            Route::post('add-update-cart',[CartController::class,'customerAddUpdateCart']);
            Route::post('cart-delete',[CartController::class,'customerCartDelete']);
            Route::post('cart-list',[CartController::class,'customerCartList']);

            //Address
            Route::post('get-address',[CustomerAddressController::class,'customerGetAddress']);
            Route::post('get-address-by-pincode',[CustomerAddressController::class,'getAddressByPincode']);
            Route::post('store-update-address',[CustomerAddressController::class,'storeUpdate']);
            Route::post('delete-address',[CustomerAddressController::class,'customerDeleteAddress']);

            //Order
            Route::post('store-order',[OrderController::class,'customerStoreOrder']);
            Route::post('order-list',[OrderController::class,'customerOrderList']);
            Route::post('order-detail',[OrderController::class,'customerOrderDetail']);

            //Profile
            Route::post('get-profile',[CustomerProfileController::class,'profileCustomer']);
            Route::post('save-profile',[CustomerProfileController::class,'customerSaveProfile']);

        });
    });

// ******************************   End Customer App Api  ****************************** //



// ******************************   Start Dealer App Api  ****************************** //

    Route::prefix("dealer")->group(function(){

        //Login
        Route::post('login',[LoginController::class,'businessPersonLogin']);

        Route::middleware('auth:sanctum')->group( function () {

            //Home
            Route::post('home',[HomeController::class,'businessPersonHome']);

        });

    });

// ******************************   End Dealer App Api  ****************************** //
