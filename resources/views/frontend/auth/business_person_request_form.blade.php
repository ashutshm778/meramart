@extends('frontend.layouts.app')
@section('content')

<style>
    .error
    {
        color:red !important;
        margin-top: -22px;
    }
    .form-control.is-valid, .was-validated .form-control:valid {
        border-color: #198754 !important;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e);
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
</style>

    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Business Person Request</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Business Person Request</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="image-contain">
                        <img src="{{asset('public/frontend/assets/images/sign-up.jpg')}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="ec-register-wrapper col-md-7">
                    <div class="ec-register-container">
                        <div class="ec-register-form">
                            <form id="valid_form" action="{{route('business.person.request.save')}}" method="post">
                                @csrf
                                <span class="ec-register-wrap ec-register-half">
                                    <label>First Name<span style="color:red">*<span></label> <br>
                                    <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="Enter your First Name..." required />
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </span>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Last Name<span style="color:red">*<span></label> <br>
                                    <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="Enter Your Last Name..." required />
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </span>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Phone Number<span style="color:red">*<span></label> <br>
                                    <input type="number" class="form-control" id="phone" name="phone" value="{{old('phone')}}" placeholder="Enter Your Phone Number..." onchange="getOtp()" required>
                                    <span class="error invalid-feedback" id="phone_error" style="display:none">Phone Number Already Exists</span>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap ec-register-half">
                                    <label>OTP<span style="color:red">*<span></label> <br>
                                    <input type="number" class="form-control" id="otp" name="otp" value="{{old('otp')}}" placeholder="Enter Your OTP..." required />
                                    <span class="error invalid-feedback" id="otp_error" style="display:none">Wrong OTP</span>
                                    <span class="text-success" id="otp_success" style="display:none">Match OTP</span>
                                    @if ($errors->has('otp'))
                                        <span class="text-danger">{{ $errors->first('otp') }}</span>
                                    @endif
                                </span>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Business Name<span style="color:red">*<span></label> <br>
                                    <input type="text" class="form-control" id="business_name" name="business_name" value="{{old('business_name')}}" placeholder="Enter Your Business Name..." required />
                                    @if ($errors->has('business_name'))
                                        <span class="text-danger">{{ $errors->first('business_name') }}</span>
                                    @endif
                                </span>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Brand Type<span style="color:red">*<span></label> <br>
                                    <span class="ec-bl-select-inner ">
                                    <select class="ec-bill-select" name="type" id="type" required>
                                        <option value="">Select Business Type...</option>
                                        <option value="distributor">Distributor</option>
                                        <option value="wholeseller">Wholeseller</option>
                                    </select>
                                    </span>
                                </span>
                                <span class="ec-register-wrap ec-register-btn">
                                    <button class="btn btn-primary" type="button" onclick="verifyOtp()">Send Request for Details</button>
                                    <div class="text-center">
                                        <p class="mt-2">Already have an account? <a href="{{ route('user.login') }}"> Login</a></p>
                                    </div>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

<script>

    function getOtp()
    {

        var phone=$('#phone').val();
        var otp=$('#otp').val('');

        $.get("{{route('send.otp','')}}"+"/"+phone+"?from=dealer", function(data) {
            if(data == 1)
            {
                $('#phone').removeClass('is-invalid');
                $('#phone').addClass('is-valid');
                $('#phone_error').css('display','none');
            }
            else if(data == 2)
            {
                $('#phone').addClass('is-invalid');
                $('#phone').removeClass('is-valid');
                $('#phone_error').css('display','block');
                $('#phone_error').text('You have already submitted your request.');
            }
            else if(data == 3)
            {
                $('#phone').addClass('is-invalid');
                $('#phone').removeClass('is-valid');
                $('#phone_error').css('display','block');
                $('#phone_error').text('You have already registered.');
            }
        });

    }

    function verifyOtp()
    {
        var validation = $("#valid_form").valid();
        if (validation) {
            var phone=$('#phone').val();
            var otp=$('#otp').val();
            $.get("{{route('verify.otp',['',''])}}"+"/"+phone+"/"+otp, function(data)
            {
                $('#otp').removeClass('is-invalid');
                $('#otp').addClass('is-valid');
                $('#otp_success').css('display','block');
                $('#otp_success').text('Match OTP');
                $('#otp_error').css('display','none');
                $('#valid_form').submit();
            }).fail(function()
            {
                $('#otp').addClass('is-invalid');
                $('#otp').removeClass('is-valid');
                $('#otp_success').css('display','none');
                $('#otp_error').css('display','block');
                $('#otp_error').text('Wrong OTP');
            });
        }
        else
        {
            return false;
        }

    }

</script>
