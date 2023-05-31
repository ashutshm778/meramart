@extends('frontend.layouts.app')
@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Blog Page</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Blog Page</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Blog page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-blogs-rightside col-lg-8 col-md-12">

                    <!-- Blog content Start -->
                    <div class="ec-blogs-content">
                        <div class="ec-blogs-inner">
                            <div class="ec-blog-main-img">
                                <img class="blog-image" src="{{asset('public/frontend/assets/images/blog-image/7.jpg')}}" alt="Blog" />
                            </div>
                            <div class="ec-blog-date">
                                <p class="date">28 JUNE, 2022-2023 - </p><a href="javascript:void(0)">5 Comments</a>
                            </div>
                            <div class="ec-blog-detail">
                                <h3 class="ec-blog-title">20 Most awerded and trending items 2022-2023</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                    irure dolor in reprhendit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur. </p>
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qei officia deser
                                    mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
                                    voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                <p class="blockquote">Lorem ipsum dolor sit amet, consecte adipisicing elit, sed do
                                    eiusmod tempor incididunt labo dolor magna aliqua. Ut enim ad minim veniam quis
                                    nostrud.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                    irure dolor in reprehendrit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur.</p>
                                <div class="ec-blog-sub-imgs">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img class="blog-image" src="{{asset('public/frontend/assets/images/blog-image/2.jpg')}}" alt="Blog" />
                                        </div>
                                        <div class="col-md-6">
                                            <img class="blog-image" src="{{asset('public/frontend/assets/images/blog-image/3.jpg')}}" alt="Blog" />
                                        </div>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                    irure dolor in reprehendrit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur.</p>
                            </div>
                            <div class="ec-blog-tags">
                                <a href="{{route('blog_details')}}">lifestyle ,</a>
                                <a href="{{route('blog_details')}}">Outdoor ,</a>
                                <a href="{{route('blog_details')}}">interior ,</a>
                                <a href="{{route('blog_details')}}">sports ,</a>
                                <a href="{{route('blog_details')}}">bloging ,</a>
                                <a href="{{route('blog_details')}}">inspiration</a>
                            </div>
                        </div>
                    </div>
                    <!--Blog content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-blogs-leftside col-lg-4 col-md-12">
                    <div class="ec-blog-search">
                        <form class="ec-blog-search-form" action="#">
                            <input class="form-control" placeholder="Search Our Blog" type="text">
                            <button class="submit" type="submit"><i class="ecicon eci-search"></i></button>
                        </form>
                    </div>
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Recent Blog Block -->
                        <div class="ec-sidebar-block ec-sidebar-recent-blog">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Recent Articles</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-sidebar-block-item">
                                    <h5 class="ec-blog-title"><a href="{{route('blog_details')}}">The best fashion influencers.</a></h5>
                                    <div class="ec-blog-date">Sep 10, 2022-2023</div>
                                </div>
                                <div class="ec-sidebar-block-item">
                                    <h5 class="ec-blog-title"><a href="{{route('blog_details')}}">Vogue Shopping Weekend.</a></h5>
                                    <div class="ec-blog-date">Sep 10, 2022-2023</div>
                                </div>
                                <div class="ec-sidebar-block-item">
                                    <h5 class="ec-blog-title"><a href="{{route('blog_details')}}">Fashion Market Reveals Her Jacket.</a></h5>
                                    <div class="ec-blog-date">Sep 10, 2022-2023</div>
                                </div>
                                <div class="ec-sidebar-block-item">
                                    <h5 class="ec-blog-title"><a href="{{route('blog_details')}}">Summer Trending Fashion Market.</a></h5>
                                    <div class="ec-blog-date">Sep 10, 2022-2023</div>
                                </div>
                                <div class="ec-sidebar-block-item">
                                    <h5 class="ec-blog-title"><a href="{{route('blog_details')}}">Winter 2021 Trending Fashion Market</a></h5>
                                    <div class="ec-blog-date">Sep 10, 2022-2023</div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Recent Blog Block -->
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Categories</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" checked /> <a href="#">clothes</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" /> <a href="#">Bags</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" /> <a href="#">Shoes</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" /> <a href="#">cosmetics</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" /> <a href="#">electrics</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" /> <a href="#">phone</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li id="ec-more-toggle-content" style="padding: 0; display: none;">
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-block-item">
                                                    <input type="checkbox" /> <a href="#">Watch</a><span
                                                        class="checked"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-block-item">
                                                    <input type="checkbox" /> <a href="#">Cap</a><span
                                                        class="checked"></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item ec-more-toggle">
                                            <span class="checked"></span><span id="ec-more-toggle">More
                                                Categories</span>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar Category Block -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
