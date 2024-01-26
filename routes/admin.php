<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AizUploadController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\BrnadController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PincodeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\SalesTeamController;
use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\DealerOrderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\AssignDealerController;
use App\Http\Controllers\Admin\AssignTargetController;
use App\Http\Controllers\Admin\OfferProductController;
use App\Http\Controllers\Admin\ProductStockController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\BusinessPersonRequestController;
use App\Http\Controllers\Admin\FeatureActivationController;
use App\Http\Controllers\Admin\AssignDealerTargetController;
use App\Http\Controllers\Admin\DealerOrderRequestController;
use App\Http\Controllers\Admin\ModifyDelearOrderRequestController;


Route::prefix("admin")->group(function(){

    Auth::routes();

    Route::group(['middleware' => ['auth'],'as'=>'admin.'], function() {

        //Dashboard
        Route::get('home', [HomeController::class, 'index'])->name('home');

        //Category
        Route::resource('categories', CategoryController::class)->except('destroy');
        Route::get('categories-feature/{id}', [CategoryController::class,'feature'])->name('categories.feature');
        Route::get('categories-delete/{id}', [CategoryController::class,'destroy'])->name('categories.destroy');
        Route::post('categories-priority', [CategoryController::class,'priority'])->name('categories.priority');
        Route::get('categorywise_priorty/{drag_id}/{replace_id}/{type}', [CategoryController::class,'categorywisePriorty'])->name('categorywise.priorty');
        Route::get('category-priority-data/{type}', [CategoryController::class,'categoryPriortyData'])->name('category.priority.data');

        //SubCategory
        Route::resource('sub-categories', SubCategoryController::class)->except('destroy');
        Route::get('sub-categories-delete/{id}', [SubCategoryController::class,'destroy'])->name('sub-categories.destroy');
        Route::post('get-sub-categories-by-category', [SubCategoryController::class,'getSubCategoriesByCategory'])->name('get.sub.categories.by.category');

        //SubSubCategory
        Route::resource('sub-sub-categories', SubSubCategoryController::class)->except('destroy');
        Route::get('sub-sub-categories-delete/{id}', [SubSubCategoryController::class,'destroy'])->name('sub.sub.categories.destroy');
        Route::post('get-sub-sub-categories-by-category', [SubSubCategoryController::class,'getSubSubCategoriesBySubCategory'])->name('get.sub.sub.categories.by.subcategory');

        //Brand
        Route::resource('brands', BrnadController::class)->except('destroy');
        Route::get('brands-delete/{id}', [BrnadController::class,'destroy'])->name('brands.destroy');

        //Attribute
        Route::resource('attributes', AttributeController::class)->except('destroy');
        Route::get('attributes-delete/{id}', [AttributeController::class,'destroy'])->name('attributes.destroy');
        Route::get('get-attributes-by-category/{category_id}', [AttributeController::class,'getAttributesByCategory'])->name('get.attributes.by.category');
        Route::get('get-attribute-value/{attribute_id}', [AttributeController::class,'getAttributeValue'])->name('get.attribute.value');

        //Color
        Route::resource('colors', ColorController::class)->except('destroy');
        Route::get('colors-delete/{id}', [ColorController::class,'destroy'])->name('colors.destroy');

        //Unit
        Route::resource('units',UnitController::class)->except('create','show','update');

        //Product
        Route::resource('products', ProductController::class)->except('destroy');
        Route::get('products-destroy/{id}', [ProductController::class,'destroy'])->name('products.destroy');
        Route::get('products-status-index', [ProductController::class,'productStatusIndex'])->name('products.status.index');
        Route::get('products-status-update/{id}/{status}', [ProductController::class,'productStatusUpdate'])->name('products.status.update');
        Route::get('low-stock-products', [ProductController::class,'lowStockProduct'])->name('low.stock.products');

        //Product Purchase Invoice
        if(featureActivation('purchase_vendor') == '1'){
            Route::resource('product-stocks', ProductStockController::class)->except('destroy');
            Route::post('get-product', [ProductStockController::class,'getProduct'])->name('get.products');
            Route::post('get-product-table', [ProductStockController::class,'getProductTable'])->name('get.product.table');
        }

        //Business Person Request
        if(featureActivation('distributor') == '1' || featureActivation('wholesaler') == '1'){
            Route::get('business-person-request-index', [BusinessPersonRequestController::class,'index'])->name('business.person.request.index');
            Route::get('business-person-request-edit/{id}', [BusinessPersonRequestController::class,'edit'])->name('business.person.request.edit');
            Route::post('business-person-request-update/{id}', [BusinessPersonRequestController::class,'update'])->name('business.person.request.update');
        }

        //Customers
        if(featureActivation('retailer') == '1'){
            Route::get('customers-index',[CustomerController::class,'index'])->name('customers.index');
            Route::get('customer-payout/{customer_id}',[CustomerController::class,'payout'])->name('customer.payout');
            Route::get('customer-level-income/{customer_id}',[CustomerController::class,'levelIncome'])->name('customer.level.income');
            Route::get('customer-level-team/{customer_id}/{level}',[CustomerController::class,'levelTeam'])->name('customer.level.team');
            Route::get('customer-reward-list/{customer_id}',[CustomerController::class,'customerRewardList'])->name('customer.reward.list');
            Route::get('customer-login/{customer_id}',[CustomerController::class,'customer_login'])->name('customer_login');
            Route::get('customers-delete/{id}',[CustomerController::class,'destroy'])->name('customers.destroy');

        }
        Route::post('customers-verification', [CustomerController::class,'updateVerificationStatus'])->name('customers.updateVerificationStatus');

        //App Setting
        Route::get('slider-index', [AppSettingController::class,'sliderIndex'])->name('slider.index');
        Route::get('slider-create', [AppSettingController::class,'sliderCreate'])->name('slider.create');
        Route::post('slider-store', [AppSettingController::class,'sliderStore'])->name('slider.store');
        Route::get('slider-destroy/{id}', [AppSettingController::class,'sliderDestroy'])->name('slider.destroy');

        //Website Setting
        Route::get('website-setting-index', [WebsiteSettingController::class,'index'])->name('website.setting.index');
        Route::get('website-setting-create', [WebsiteSettingController::class,'create'])->name('website.setting.create');
        Route::post('website-setting-store', [WebsiteSettingController::class,'store'])->name('website.setting.store');
        Route::get('website-setting-destroy/{id}', [WebsiteSettingController::class,'destroy'])->name('website.setting.destroy');
        Route::get('website-setting-data', [WebsiteSettingController::class,'websiteSettingData'])->name('website.setting.data');
        Route::post('website-setting-data-store', [WebsiteSettingController::class,'websiteSettingDataStore'])->name('website.setting.data.store');

        //Admin Setting
        Route::get('admin-setting-index', [WebsiteSettingController::class,'adminIndex'])->name('setting.index');

        //Offers
        Route::resource('offers', OfferController::class)->except('destroy');
        Route::get('offers-destroy/{id}',[OfferController::class,'destroy'])->name('offers.destroy');
        Route::post('offers-products', [OfferController::class,'offerProduct'])->name('offers.products');
        Route::post('get-offers-products-table', [OfferController::class,'getOfferProductTable'])->name('get.offers.products.table');
        Route::post('save-offers-products', [OfferProductController::class,'saveOffersProducts'])->name('save.offers.products');
        Route::post('update-offers-products/{offer_id}', [OfferProductController::class,'updateOffersProducts'])->name('update.offers.products');

        //Sales Team Management
        Route::get('sales-team-index', [SalesTeamController::class,'index'])->name('sales.team.index');
        Route::get('sales-team-create', [SalesTeamController::class,'create'])->name('sales.team.create');
        Route::post('sales-team-store', [SalesTeamController::class,'store'])->name('sales.team.store');
        Route::get('sales-team-edit/{id}', [SalesTeamController::class,'edit'])->name('sales.team.edit');
        Route::put('sales-team-update/{id}', [SalesTeamController::class,'update'])->name('sales.team.update');

        //Assign Dealer
        Route::get('assign-dealer-index', [AssignDealerController::class,'index'])->name('assign.dealer.index');
        Route::get('assign-dealer-create', [AssignDealerController::class,'create'])->name('assign.dealer.create');
        Route::get('get-dealers-list/{sales_member_id}', [AssignDealerController::class,'getDealersList'])->name('get.dealers.list');
        Route::post('assign-dealer-store', [AssignDealerController::class,'store'])->name('assign.dealer.store');

        //Assign Sales Target
        Route::get('assign-target-index/{sales_member_id}', [AssignTargetController::class,'index'])->name('assign.target.index');
        Route::post('assign-target-store', [AssignTargetController::class,'store'])->name('assign.target.store');

        //Assign Dealer Target
        Route::get('assign-dealer-target-index/{dealer_id}', [AssignDealerTargetController::class,'index'])->name('assign.dealer.target.index');
        Route::post('assign-dealer-target-store', [AssignDealerTargetController::class,'store'])->name('assign.dealer.target.store');

        //Dealer
        Route::get('dealer-index',[DealerController::class,'index'])->name('dealer.index');

        //Vendors
        if(featureActivation('purchase_vendor') == '1'){
            Route::resource('vendors', VendorController::class)->except('destroy');
            Route::get('vendors-destroy/{id}', [VendorController::class,'destroy'])->name('vendors.destroy');
        }

        //Role Management
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);

        //Country
        Route::resource('countries',CountryController::class)->except('destroy');
        Route::get('admin-countries-destroy/{id}', [CountryController::class,'destroy'])->name('countries.destroy');

        //State
        Route::resource('states',StateController::class)->except('destroy');
        Route::get('admin-states-destroy/{id}', [StateController::class,'destroy'])->name('states.destroy');
        Route::get('admin-get-states/{country_id}',[StateController::class,'getStates'])->name('get.states');

        //City
        Route::resource('cities',CityController::class)->except('destroy');
        Route::get('admin-cities-destroy/{id}', [CityController::class,'destroy'])->name('cities.destroy');
        Route::get('admin-get-cities/{state_id}',[CityController::class,'getCities'])->name('get.cities');

        //Pincode
        Route::resource('pincodes',PincodeController::class)->except('destroy');
        Route::get('admin-pincodes-destroy/{id}', [PincodeController::class,'destroy'])->name('pincodes.destroy');

        //Customer Orders
        Route::get('orders-index',[OrderController::class,'index'])->name('orders.index');
        Route::get('order-detail/{order_id}',[OrderController::class,'detail'])->name('order.detail');
        Route::post('order-product-status',[OrderController::class,'productStatus'])->name('order.product.status');
        Route::post('order-payment-status',[OrderController::class,'paymentStatus'])->name('order.payment.status');

        //Dealer Order Request
        Route::get('dealer-order-list',[DealerOrderRequestController::class,'dealerOrderList'])->name('dealer.order.list');
        Route::get('dealer-order-detail/{order_request_id}',[DealerOrderRequestController::class,'dealerOrderDetail'])->name('dealer.order.detail');
        Route::post('modify-dealer-order',[ModifyDelearOrderRequestController::class,'modifyDealerOrder'])->name('modify.dealer.order');
        Route::get('confirm-dealer-order/{order_id}',[DealerOrderRequestController::class,'confirmDealerOrder'])->name('confirm.dealer.order');

        //Dealer Orders
        Route::get('dealer-final-order-list',[DealerOrderController::class,'dealerFinalOrderList'])->name('dealer.final.order.list');
        Route::get('dealer-final-order-detail/{order_id}',[DealerOrderController::class,'dealerFinalOrderDetail'])->name('dealer.final.order.detail');
        Route::get('dealer-final-order-product-status/{order_id}/{product_id}/{status}',[DealerOrderController::class,'dealerFinalOrderProductStatus'])->name('dealer.final.order.product.status');
        Route::get('dealer-final-order-status/{order_id}/{status}',[DealerOrderController::class,'dealerFinalOrderStatus'])->name('dealer.final.order.status');

        //Coupon
        Route::resource('coupons',CouponController::class);
        Route::get('coupons-status/{id}/{status}',[CouponController::class,'status'])->name('coupons.status');
        Route::post('get-coupon-product-table', [CouponController::class,'getCouponProductTable'])->name('get.coupon.product.table');

        //Payout
        Route::get('payout-index',[PayoutController::class,'index'])->name('payout.index');
        Route::post('payout-store',[PayoutController::class,'store'])->name('payout.store');

        //Setup & Configuration
        Route::get('feature-activation-index',[FeatureActivationController::class,'index'])->name('feature.activation.index');
        Route::post('feature-activation-store',[FeatureActivationController::class,'store'])->name('feature.activation.store');

        //Reward
        Route::resource('reward', RewardController::class);

        // Upload multiple Images
        Route::post('/aiz-uploader', [AizUploadController::class, 'show_uploader']);
        Route::post('/aiz-uploader/upload', [AizUploadController::class, 'upload']);
        Route::get('/aiz-uploader/get_uploaded_files', [AizUploadController::class, 'get_uploaded_files']);
        Route::delete('/aiz-uploader/destroy/{id}', [AizUploadController::class, 'destroy']);
        Route::post('/aiz-uploader/get_file_by_ids', [AizUploadController::class, 'get_preview_files']);
        Route::get('/aiz-uploader/download/{id}', [AizUploadController::class, 'attachment_download'])->name('download_attachment');

        Route::get('profile',[HomeController::class,'admin_profile'])->name('profile');
        Route::post('profile/update',[HomeController::class,'admin_profile_update'])->name('profile.update');

    });

});
