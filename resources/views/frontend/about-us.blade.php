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
                                <h3 class="ec-cms-block-title">Mera Mart</h3>
                                <p>Mera Mart is a fast growing direct selling company, you can give another direction to your life by joining it. After you join this company which is going to make best option in direct selling for your future. We have introduced a cost-effective business concept that has the power to radically change your life. Mera Mart is a direct selling business and manufacturing process of banarasi sarees, suits, kurtas, sherwanis and etc garments. Work in e-commerce with clothing products. Mera Mart believes that the success of an organization depends on the quality of its people. The best minds produce the best results. They dedicated themselves to research how to meet each and every requirement of our dear nationwide members. We have grown as an organization and continue to play a leading role.</p>
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
