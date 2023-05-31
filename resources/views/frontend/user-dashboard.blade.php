@extends('frontend.layouts.app')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">User Dashboard</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">User Dashboard</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->
    <section class="ec-page-content ec-vendor-dashboard section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                @include('frontend.user_sidebar')
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="ec-vendor-dashboard-sort-card color-blue">
                                <h5>Products</h5>
                                <h3>625</h3>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="ec-vendor-dashboard-sort-card color-pink">
                                <h5>Orders</h5>
                                <h3>56<span>/ Day</span></h3>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="ec-vendor-dashboard-sort-card color-green">
                                <h5>Earnings</h5>
                                <h3>₹56<span>/ Day</span></h3>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="ec-vendor-dashboard-sort-card color-orange">
                                <h5>Sales</h5>
                                <h3>550<span>/ Mo</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="ec-vendor-dashboard-card space-bottom-30">
                        <div class="ec-vendor-card-header">
                            <h5>Latest Order</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="#">View All</a>
                            </div>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Method</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><span>225</span></th>
                                            <td><img class="prod-img" src="{{asset('public/frontend/assets/images/category/category-sofa.jpg')}}"
                                                    alt="product image"></td>
                                            <td><span>Stylish baby shoes</span></td>
                                            <td><span>COD</span></td>
                                            <td><span>Pending</span></td>
                                            <td><span>₹320</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><span>548</span></th>
                                            <td><img class="prod-img" src="{{asset('public/frontend/assets/images/category/category-sofa.jpg')}}"
                                                    alt="product image"></td>
                                            <td><span>Sweat Pullover Hoodie</span></td>
                                            <td><span>Cash</span></td>
                                            <td><span>Pending</span></td>
                                            <td><span>₹214</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><span>684</span></th>
                                            <td><img class="prod-img" src="{{asset('public/frontend/assets/images/category/category-sofa.jpg')}}"
                                                    alt="product image"></td>
                                            <td><span>T-shirt for girl</span></td>
                                            <td><span>Ewallets</span></td>
                                            <td><span>On Way</span></td>
                                            <td><span>₹548</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><span>987</span></th>
                                            <td><img class="prod-img" src="{{asset('public/frontend/assets/images/category/category-sofa.jpg')}}"
                                                    alt="product image"></td>
                                            <td><span>Wool hat for men</span></td>
                                            <td><span>Bank Transfers</span></td>
                                            <td><span>Delivered</span></td>
                                            <td><span>₹200</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection
