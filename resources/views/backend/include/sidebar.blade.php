<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @php
        $logo = App\Models\Admin\WebsiteSetting::where('type','logo')->first();
    @endphp
    <a href="#" class="brand-link">
        <img src="{{asset('public/'.api_asset(optional($logo)->image))}}" alt="Green Orbit" class="brand-image">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.home')}}" class="nav-link @if(Route::currentRouteName() == 'home') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'admin.categories.index' ||
                                        Route::currentRouteName() == 'admin.categories.create' ||
                                        Route::currentRouteName() == 'admin.categories.edit' ||
                                        Route::currentRouteName() == 'admin.sub-categories.index' ||
                                        Route::currentRouteName() == 'admin.sub-categories.create' ||
                                        Route::currentRouteName() == 'admin.sub-categories.edit' ||
                                        Route::currentRouteName() == 'admin.sub-sub-categories.index' ||
                                        Route::currentRouteName() == 'admin.sub-sub-categories.create' ||
                                        Route::currentRouteName() == 'admin.sub-sub-categories.edit' ||
                                        Route::currentRouteName() == 'admin.brands.index' ||
                                        Route::currentRouteName() == 'admin.brands.create' ||
                                        Route::currentRouteName() == 'admin.brands.edit' ||
                                        Route::currentRouteName() == 'admin.attributes.index' ||
                                        Route::currentRouteName() == 'admin.attributes.create' ||
                                        Route::currentRouteName() == 'admin.attributes.edit' ||
                                        Route::currentRouteName() == 'admin.colors.index' ||
                                        Route::currentRouteName() == 'admin.colors.create' ||
                                        Route::currentRouteName() == 'admin.colors.edit' ||
                                        Route::currentRouteName() == 'admin.products.index' ||
                                        Route::currentRouteName() == 'admin.products.create' ||
                                        Route::currentRouteName() == 'admin.products.edit' ||
                                        Route::currentRouteName() == 'admin.products.status.index' ||
                                        Route::currentRouteName() == 'admin.product-stocks.index' ||
                                        Route::currentRouteName() == 'admin.product-stocks.create' ||
                                        Route::currentRouteName() == 'admin.product-stocks.show' ||
                                        Route::currentRouteName() == 'admin.low.stock.products' ||
                                        Route::currentRouteName() == 'admin.units.index' ||
                                        Route::currentRouteName() == 'admin.units.edit'
                                    ) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.categories.index' ||
                                                    Route::currentRouteName() == 'admin.categories.create' ||
                                                    Route::currentRouteName() == 'admin.categories.edit' ||
                                                    Route::currentRouteName() == 'admin.sub-categories.index' ||
                                                    Route::currentRouteName() == 'admin.sub-categories.create' ||
                                                    Route::currentRouteName() == 'admin.sub-categories.edit' ||
                                                    Route::currentRouteName() == 'admin.sub-sub-categories.index' ||
                                                    Route::currentRouteName() == 'admin.sub-sub-categories.create' ||
                                                    Route::currentRouteName() == 'admin.sub-sub-categories.edit' ||
                                                    Route::currentRouteName() == 'admin.brands.index' ||
                                                    Route::currentRouteName() == 'admin.brands.create' ||
                                                    Route::currentRouteName() == 'admin.brands.edit' ||
                                                    Route::currentRouteName() == 'admin.attributes.index' ||
                                                    Route::currentRouteName() == 'admin.attributes.create' ||
                                                    Route::currentRouteName() == 'admin.attributes.edit' ||
                                                    Route::currentRouteName() == 'admin.colors.index' ||
                                                    Route::currentRouteName() == 'admin.colors.create' ||
                                                    Route::currentRouteName() == 'admin.colors.edit' ||
                                                    Route::currentRouteName() == 'admin.products.index' ||
                                                    Route::currentRouteName() == 'admin.products.create' ||
                                                    Route::currentRouteName() == 'admin.products.edit' ||
                                                    Route::currentRouteName() == 'admin.products.status.index' ||
                                                    Route::currentRouteName() == 'admin.product-stocks.index' ||
                                                    Route::currentRouteName() == 'admin.product-stocks.create' ||
                                                    Route::currentRouteName() == 'admin.product-stocks.show' ||
                                                    Route::currentRouteName() == 'admin.low.stock.products' ||
                                                    Route::currentRouteName() == 'admin.units.index' ||
                                                    Route::currentRouteName() == 'admin.units.edit'
                                                ) active @endif">
                        <i class="nav-icon fa fa-archive" aria-hidden="true"></i>
                        <p>Product Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if(Route::currentRouteName() == 'admin.products.index' ||
                                                Route::currentRouteName() == 'admin.products.create' ||
                                                Route::currentRouteName() == 'admin.products.edit' ||
                                                Route::currentRouteName() == 'admin.products.status.index' ||
                                                Route::currentRouteName() == 'admin.product-stocks.index' ||
                                                Route::currentRouteName() == 'admin.product-stocks.create' ||
                                                Route::currentRouteName() == 'admin.product-stocks.show' ||
                                                Route::currentRouteName() == 'admin.low.stock.products'
                                            ) menu-is-opening menu-open @endif">
                            <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.products.index' ||
                                                            Route::currentRouteName() == 'admin.products.create' ||
                                                            Route::currentRouteName() == 'admin.products.edit' ||
                                                            Route::currentRouteName() == 'admin.products.status.index' ||
                                                            Route::currentRouteName() == 'admin.product-stocks.index' ||
                                                            Route::currentRouteName() == 'admin.product-stocks.create' ||
                                                            Route::currentRouteName() == 'admin.product-stocks.show' ||
                                                            Route::currentRouteName() == 'admin.low.stock.products'
                                                        ) active @endif">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Product<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.products.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.products.index' || Route::currentRouteName() == 'admin.products.create' || Route::currentRouteName() == 'admin.products.edit') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.products.status.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.products.status.index') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Status</p>
                                    </a>
                                </li>
                                @if(featureActivation('purchase_vendor') == '1')
                                    <li class="nav-item">
                                        <a href="{{route('admin.product-stocks.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.product-stocks.index' || Route::currentRouteName() == 'admin.product-stocks.create' || Route::currentRouteName() == 'admin.product-stocks.show') active @endif">
                                            <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                            <p>Manage Stock / Purchase</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.low.stock.products')}}" class="nav-link @if(Route::currentRouteName() == 'admin.low.stock.products') active @endif">
                                            <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                            <p>Low Stock</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.categories.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.categories.index' || Route::currentRouteName() == 'admin.categories.create' || Route::currentRouteName() == 'admin.categories.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.sub-categories.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.sub-categories.index' || Route::currentRouteName() == 'admin.sub-categories.create' || Route::currentRouteName() == 'admin.sub-categories.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.sub-sub-categories.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.sub-sub-categories.index' || Route::currentRouteName() == 'admin.sub-sub-categories.create' || Route::currentRouteName() == 'admin.sub-sub-categories.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Sub Sub Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.brands.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.brands.index' || Route::currentRouteName() == 'admin.brands.create' || Route::currentRouteName() == 'admin.brands.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Brand</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.attributes.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.attributes.index' || Route::currentRouteName() == 'admin.attributes.create' || Route::currentRouteName() == 'admin.attributes.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Attribute</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.units.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.units.index' || Route::currentRouteName() == 'admin.units.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Unit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.colors.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.colors.index' || Route::currentRouteName() == 'admin.colors.create' || Route::currentRouteName() == 'admin.colors.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Color</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(featureActivation('retailer') == '1')
                    <li class="nav-item @if(Route::currentRouteName() == 'admin.orders.index' || Route::currentRouteName() == 'admin.order.detail') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.orders.index' || Route::currentRouteName() == 'admin.order.detail') active @endif">
                            <i class="nav-icon fa fa-shopping-cart" aria-hidden="true"></i>
                            <p>Orders
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.orders.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.orders.index' || Route::currentRouteName() == 'admin.order.detail') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>All</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(featureActivation('distributor') == '1' || featureActivation('wholesaller') == '1')
                    <li class="nav-item @if(Route::currentRouteName() == 'admin.dealer.order.list' || Route::currentRouteName() == 'admin.dealer.order.detail' || Route::currentRouteName() == 'admin.dealer.final.order.list' || Route::currentRouteName() == 'admin.dealer.final.order.detail') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.dealer.order.list' || Route::currentRouteName() == 'admin.dealer.order.detail' || Route::currentRouteName() == 'admin.dealer.final.order.list' || Route::currentRouteName() == 'admin.dealer.final.order.detail') active @endif">
                            <i class="nav-icon fa fa-shopping-cart" aria-hidden="true"></i>
                            <p>Dealer Orders
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.dealer.order.list')}}" class="nav-link @if(Route::currentRouteName() == 'admin.dealer.order.list' || Route::currentRouteName() == 'admin.dealer.order.detail') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Requests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.dealer.final.order.list')}}" class="nav-link @if(Route::currentRouteName() == 'admin.dealer.final.order.list' || Route::currentRouteName() == 'admin.dealer.final.order.detail') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Orders</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(featureActivation('retailer') == '1')
                    <li class="nav-item">
                        <a href="{{route('admin.customers.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.customers.index') active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Customers</p>
                        </a>
                    </li>
                @endif
                @if(featureActivation('distributor') == '1' || featureActivation('wholesaller') == '1')
                    <li class="nav-item @if(Route::currentRouteName() == 'admin.business.person.request.index' || Route::currentRouteName() == 'admin.business.person.request.edit') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.business.person.request.index' || Route::currentRouteName() == 'admin.business.person.request.edit') active @endif">
                            <i class="nav-icon fa fa-user-plus" aria-hidden="true"></i>
                            <p>
                                Dealer/Distributor
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.business.person.request.index').'?type=all' }}" class="nav-link @if(Route::currentRouteName() == 'admin.business.person.request.index' || Route::currentRouteName() == 'admin.business.person.request.edit') @if(request()->type == 'all') active @endif @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>All</p>
                                </a>
                            </li>

                            <li class="nav-item" >
                                <a href="{{ route('admin.business.person.request.index').'?type=pending' }}" class="nav-link @if(Route::currentRouteName() == 'admin.business.person.request.index' || Route::currentRouteName() == 'admin.business.person.request.edit') @if(request()->type == 'pending') active @endif @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Pending</p>
                                </a>
                            </li>

                            <li class="nav-item" >
                                <a href="{{ route('admin.business.person.request.index').'?type=approved' }}" class="nav-link @if(Route::currentRouteName() == 'admin.business.person.request.index' || Route::currentRouteName() == 'admin.business.person.request.edit') @if(request()->type == 'approved') active @endif @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Approved</p>
                                </a>
                            </li>

                            <li class="nav-item" >
                                <a href="{{ route('admin.business.person.request.index').'?type=cancel' }}" class="nav-link @if(Route::currentRouteName() == 'admin.business.person.request.index') @if(request()->type == 'cancel') active @endif @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Cancel</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(featureActivation('coupon') == '1')
                    <li class="nav-item @if(Route::currentRouteName() == 'admin.coupons.index' || Route::currentRouteName() == 'admin.coupons.create' || Route::currentRouteName() == 'admin.coupons.edit') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.coupons.index' || Route::currentRouteName() == 'admin.coupons.create' || Route::currentRouteName() == 'admin.coupons.edit') active @endif">
                            <i class="nav-icon fa fa-bullhorn" aria-hidden="true"></i>
                            <p>Marketing
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.coupons.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.coupons.index' || Route::currentRouteName() == 'admin.coupons.create' || Route::currentRouteName() == 'admin.coupons.edit') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Coupon</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(featureActivation('offer') == '1')
                    <li class="nav-item @if(Route::currentRouteName() == 'admin.offers.index' || Route::currentRouteName() == 'admin.offers.create') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.offers.index' || Route::currentRouteName() == 'admin.offers.create') active @endif">
                            <i class="nav-icon fa fa-certificate" aria-hidden="true"></i>
                            <p>Offer Setting
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.offers.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.offers.index' || Route::currentRouteName() == 'admin.offers.create') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Offer</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(featureActivation('purchase_vendor') == '1')
                    <li class="nav-item">
                        <a href="{{route('admin.vendors.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.vendors.index' || Route::currentRouteName() == 'admin.vendors.create' || Route::currentRouteName() == 'admin.vendors.edit') active @endif">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Vendor </p>
                        </a>
                    </li>
                @endif
                @if(featureActivation('distributor') == '1' || featureActivation('wholesaller') == '1')
                    <li class="nav-item">
                        <a href="{{route('admin.dealer.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.dealer.index' || Route::currentRouteName() == 'admin.assign.dealer.target.index') active @endif">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Dealers  </p>
                        </a>
                    </li>
                @endif
                @if(featureActivation('sales_team') == '1')
                    <li class="nav-item @if(Route::currentRouteName() == 'admin.sales.team.index' || Route::currentRouteName() == 'admin.assign.dealer.index' || Route::currentRouteName() == 'admin.assign.target.index') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.sales.team.index' || Route::currentRouteName() == 'admin.assign.dealer.index' || Route::currentRouteName() == 'admin.assign.target.index') active @endif">
                            <i class="nav-icon fa fa-user-plus" aria-hidden="true"></i>
                            <p>Sales Team
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.sales.team.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.sales.team.index' || Route::currentRouteName() == 'admin.assign.target.index') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Memeber</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.assign.dealer.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.assign.dealer.index') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Assign Dealer</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(featureActivation('staff_management') == '1')
                    @canany(['user-index','role-index'])
                        <li class="nav-item @if(Route::currentRouteName() == 'admin.users.index' || Route::currentRouteName() == 'admin.users.create' || Route::currentRouteName() == 'admin.users.edit' || Route::currentRouteName() == 'admin.users.show' || Route::currentRouteName() == 'admin.roles.index' || Route::currentRouteName() == 'admin.roles.create' || Route::currentRouteName() == 'admin.roles.edit' || Route::currentRouteName() == 'admin.roles.show') menu-is-opening menu-open @endif">
                            <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.users.index' || Route::currentRouteName() == 'admin.users.create' || Route::currentRouteName() == 'admin.users.edit' || Route::currentRouteName() == 'admin.users.show' || Route::currentRouteName() == 'admin.roles.index' || Route::currentRouteName() == 'admin.roles.create' || Route::currentRouteName() == 'admin.roles.edit' || Route::currentRouteName() == 'admin.roles.show') active @endif">
                                <i class="nav-icon fa fa-user-plus" aria-hidden="true"></i>
                                <p>Staff Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('user-index')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.users.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.users.index' || Route::currentRouteName() == 'admin.users.create' || Route::currentRouteName() == 'admin.users.edit' || Route::currentRouteName() == 'admin.users.show') active @endif">
                                            <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                            <p>Manage Users</p>
                                        </a>
                                    </li>
                                @endcan

                                <li class="nav-item" >
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.roles.index' || Route::currentRouteName() == 'admin.roles.create' || Route::currentRouteName() == 'admin.roles.edit' || Route::currentRouteName() == 'admin.roles.show') active @endif">
                                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                        <p>Manage Roles</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                @endif

                <li class="nav-item @if(Route::currentRouteName() == 'admin.countries.index' || Route::currentRouteName() == 'admin.countries.edit' || Route::currentRouteName() == 'admin.states.index' || Route::currentRouteName() == 'admin.states.edit' || Route::currentRouteName() == 'admin.cities.index' || Route::currentRouteName() == 'admin.cities.edit' || Route::currentRouteName() == 'admin.pincodes.index' || Route::currentRouteName() == 'admin.pincodes.edit') menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.countries.index' || Route::currentRouteName() == 'admin.countries.edit' || Route::currentRouteName() == 'admin.states.index' || Route::currentRouteName() == 'admin.states.edit' || Route::currentRouteName() == 'admin.cities.index' || Route::currentRouteName() == 'admin.cities.edit' || Route::currentRouteName() == 'admin.pincodes.index' || Route::currentRouteName() == 'admin.pincodes.edit') active @endif">
                        <i class="nav-icon fa fa-map-marker-alt" aria-hidden="true"></i>
                        <p>Address Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.countries.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.countries.index' || Route::currentRouteName() == 'admin.countries.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Country</p>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{ route('admin.states.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.states.index' || Route::currentRouteName() == 'admin.states.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>State</p>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{ route('admin.cities.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.cities.index' || Route::currentRouteName() == 'admin.cities.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>City</p>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{ route('admin.pincodes.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.pincodes.index' || Route::currentRouteName() == 'admin.pincodes.edit') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Pincode</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if(featureActivation('app_setting') == '1')
                    <li class="nav-item @if(Route::currentRouteName() == 'admin.slider.index' || Route::currentRouteName() == 'admin.slider.create') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.slider.index' || Route::currentRouteName() == 'admin.slider.create') active @endif">
                            <i class="nav-icon fa fa-mobile" aria-hidden="true"></i>
                            <p>App Setting
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.slider.index').'?type=slider' }}" class="nav-link @if(Route::currentRouteName() == 'admin.slider.index' || Route::currentRouteName() == 'admin.slider.create') @if(request()->type == 'slider') active @endif @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Manage Sliders</p>
                                </a>
                            </li>

                            <li class="nav-item" >
                                <a href="{{ route('admin.slider.index').'?type=banner' }}" class="nav-link @if(Route::currentRouteName() == 'admin.slider.index' || Route::currentRouteName() == 'admin.slider.create') @if(request()->type == 'banner') active @endif @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Manage Banners</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-item @if(Route::currentRouteName() == 'admin.website.setting.index' || Route::currentRouteName() == 'admin.website.setting.create' || Route::currentRouteName() == 'admin.website.setting.data') menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.website.setting.index' || Route::currentRouteName() == 'admin.website.setting.create' || Route::currentRouteName() == 'admin.website.setting.data') active @endif">
                        <i class="nav-icon fa fa-globe" aria-hidden="true"></i>
                        <p>Website Setting
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.website.setting.index').'?type=slider' }}" class="nav-link @if(Route::currentRouteName() == 'admin.website.setting.index' || Route::currentRouteName() == 'admin.website.setting.create') @if(request()->type == 'slider') active @endif @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Manage Sliders</p>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{ route('admin.website.setting.index').'?type=banner' }}" class="nav-link @if(Route::currentRouteName() == 'admin.website.setting.index' || Route::currentRouteName() == 'admin.website.setting.create') @if(request()->type == 'banner') active @endif @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Manage Banners</p>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{route('admin.website.setting.data')}}" class="nav-link @if(Route::currentRouteName() == 'admin.website.setting.data') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Manage Data</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(featureActivation('sales_team') == '1')
                    <li class="nav-item @if(Route::currentRouteName() == 'admin.setting.index') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.setting.index') active @endif">
                            <i class="nav-icon fa fa-globe" aria-hidden="true"></i>
                            <p>Admin Setting
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.setting.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.setting.index') active @endif">
                                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                    <p>Financial Month</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item @if(Route::currentRouteName() == 'admin.feature.activation.index') menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.feature.activation.index') active @endif">
                        <i class="nav-icon fa fa-cogs" aria-hidden="true"></i>
                        <p>Setup & Configuration
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.feature.activation.index')}}" class="nav-link @if(Route::currentRouteName() == 'admin.feature.activation.index') active @endif">
                                <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                                <p>Features Activation</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
