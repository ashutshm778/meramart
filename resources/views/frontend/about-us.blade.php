@extends('frontend.layouts.app')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">About Us</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">About Us</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec About Us page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-common-wrapper">
                    <div class="row">
                        <div class="col-md-5 ec-cms-block ec-abcms-block text-center">
                            <div class="ec-cms-block-inner">
                               <img class="a-img" src="{{asset('public/frontend/assets/images/about.jpg')}}" alt="about">
                            </div>
                        </div>
                        <div class="col-md-7 ec-cms-block ec-abcms-block text-center">
                            <div class="ec-cms-block-inner pt-2">

                                <div class="small-tit">About</div>
                                <h3 class="ec-cms-block-title">Green Orbit Furniture Pvt Ltd.</h3>
                                <p>Your dream is at your door. Green Orbit Furniture Pvt Ltd is marketing, collections of modular home and office durable furniture's mainly Home furniture like beds, wardrobes, dresser, having world class attractions manufactured by globally recognized KOINA" <b>NO ONE IS STYLIS THAN YOU.</b></p>
                                <p>Customer Obsession: Customers are at the center of whatever we do at Green Orbit. We ensure that we get the right customer solution in all our initiatives. We establish a long-term relationship with every customer and aim to delight them in every interaction. We aim to set the global benchmark for customer happiness scores.</p>
                                <p>Honesty & Transparency: We are honest, ethical, and trustworthy in the way we
                                    live life. We hold the highest standards of corporate governance in all our
                                    activities. We communicate transparently with all our stakeholders. When we
                                    make mistakes, we are honest and upfront about owning up to them.</p>
                                    <p>Action Orientation: We have a bias for action. We empower our teams to take
                                        fast and well informed decisions. We continuously iterate and learn from our
                                        mistakes. Scale and robustness are built in as we move along.</p>
                                <p>Stepping Up: We take charge, go the extra mile, and think differently to find
                                    innovative solutions. When in doubt, we push ourselves harder to solve newer
                                    challenges and get better solutions.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Services Section Start -->
    <section class="section mission-vision pb-6">
        <h2 class="d-none">Services</h2>
        <div class="container">
            <div class="row">
                 <div class="col-md-2">
                    <img class="a-img" src="{{asset('public/frontend/assets/images/mission.png')}}" alt="Mission">
                 </div>
                 <div class="col-md-10">
                    <h4>Mission</h4>
                    <p>Company ensure maximum strength gained Sheesham wood before using and also treats chemically by hydraulic pressure of ATT liquid to protect it from termite damage for very long duration. Seasoning Scientifically is done by maintaining a required temperature is closed chamber, which prevent any minor Twisting after manufacturing, Finishing and polishing are done with premium quality world class materials to ensure unbeatable look</p>
                 </div>

                <div class="col-md-2">
                    <img class="a-img" src="{{asset('public/frontend/assets/images/vision.png')}}" alt="Vision">
                </div>
                <div class="col-md-10">
                    <h4>Vision</h4>
                    <p>I assured you to provide transparency, credibility, honesty to serve you at reasonable cost in the domain of marketing and touch to of our valuable esteemed customers Remember to add a striking call-to-action to serve you... <b>"Your growth is our dream"</b></p>
               </div>
              </div>
            </div>
        </div>
    </section>


    @endsection
