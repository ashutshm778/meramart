@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Contact Us</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="ec-breadcrumb-item active">Contact Us</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Contact Us page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-common-wrapper">
                    <div class="ec-contact-leftside">
                        <div class="ec-contact-container">
                            <div class="ec-contact-form">
                                <form action="#" method="post">
                                    <span class="ec-contact-wrap">
                                        <input type="text" name="name" placeholder="Enter Name" required />
                                    </span>
                                    <span class="ec-contact-wrap">
                                        <input type="email" name="email" placeholder="Enter Email" required />
                                    </span>
                                    <span class="ec-contact-wrap">
                                        <input type="text" name="phonenumber" placeholder="Enter Phone" required />
                                    </span>
                                    <span class="ec-contact-wrap">
                                        <label>Comments/Questions*</label>
                                        <textarea name="address" placeholder="Please leave your comments here.."></textarea>
                                    </span>
                                    <span class="ec-contact-wrap ec-contact-btn">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="ec-contact-rightside">
                        <div class="ec_contact_map">
                            <div class="ec_map_canvas">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3605.345107334168!2d82.94393221448767!3d25.359747831310873!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e2cf96b3b1709%3A0x189bacd75e2c1332!2sShakti%20Heights%20Apartments!5e0!3m2!1sen!2sin!4v1664779243356!5m2!1sen!2sin"
                                    width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-3">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="ecicon eci-map-marker"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Our Location</h5>
                            <p>104, Shakti Height Apartment, Shivpur, Varanasi (UP)</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="ecicon eci-phone"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Contact us Anytime</h5>
                            <p>Mobile: <a href="tel:+91-7307098502"> +91-7307098502 </a></p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="ecicon eci-envelope"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Write Some Words</h5>
                            <p><a href="mailto:info@greenorbitfurniture.com">info@greenorbitfurniture.com</a></p>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
