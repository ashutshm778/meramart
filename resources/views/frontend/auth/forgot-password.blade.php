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
                            <h2 class="ec-breadcrumb-title">Register</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Register</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ec-page-content ptb-50">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-7">
                    <div class="image-contain">
                        <img src="{{asset('public/frontend/assets/images/reset-password.jpg')}}" class="img-fluid" alt="">
                    </div>
                </div> --}}

                    <div class="ec-register-wrapper col-md-5">
                        <div class="ec-register-container">
                            <div class="ec-register-form">
                                <form id="valid_form" action="{{route('customer.password_reset')}}" method="post">
                                    @csrf
                                    <span class="ec-register-wrap col-md-12">
                                        <label>Phone Number<span style="color:red">*<span></label> <br>
                                        <input type="number" class="form-control" id="phone" name="phone" value="{{old('phone')}}" placeholder="Enter Your Phone Number..." onchange="getOtp()" required>
                                        <span class="error invalid-feedback" id="phone_error" style="display:none">Phone Number Already Exists</span>
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </span>

                                    <span class="ec-register-wrap col-md-12" id="otp_div" style="display:none;">
                                        <label>OTP<span style="color:red">*<span></label> <br>
                                        <input type="number" class="form-control" id="otp" name="otp" value="{{old('otp')}}" placeholder="" onchange="verifyOtp()" required />
                                        <span class="error invalid-feedback" id="otp_error" style="display:none">Wrong OTP</span>
                                        <span class="text-success" id="otp_success" style="display:none">Match OTP</span>
                                        @if ($errors->has('otp'))
                                            <span class="text-danger">{{ $errors->first('otp') }}</span>
                                        @endif
                                    </span>

                                    <span class="ec-register-wrap ec-register-btn" id="reset_button" style="display:none;">

                                        <span class="ec-register-wrap col-md-12">
                                            <label>Password<span style="color:red">*<span></label> <br>
                                            <input type="password"  class="form-control" name="password"  required />
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </span>

                                        <button class="btn btn-primary" type="submit" >Reset Password</button>
                                        <hr>
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
        $('#otp_div').hide();
        $('#reset_button').hide();
        var phone=$('#phone').val();
        var otp=$('#otp').val('');

        $.get("{{route('send.forgototp','')}}"+"/"+phone, function(data) {
            if(data != 1)
            {
                $('#phone').addClass('is-invalid');
                $('#phone').removeClass('is-valid');
                $('#phone_error').css('display','block');
            }
            else
            {
                $('#phone').removeClass('is-invalid');
                $('#phone').addClass('is-valid');
                $('#phone_error').css('display','none');
                $('#otp_div').show();
            }
        });

    }

    function verifyOtp()
    {

            var phone=$('#phone').val();
            var otp=$('#otp').val();
            $('#reset_button').hide();
            $.get("{{route('verify.otp',['',''])}}"+"/"+phone+"/"+otp, function(data)
            {
                if(data==1){
                $('#otp').removeClass('is-invalid');
                $('#otp').addClass('is-valid');
                $('#otp_success').css('display','block');
                $('#otp_success').text('Match OTP');
                $('#otp_error').css('display','none');
                $('#reset_button').show();
                }
            }).fail(function()
            {
                $('#otp').addClass('is-invalid');
                $('#otp').removeClass('is-valid');
                $('#otp_success').css('display','none');
                $('#otp_error').css('display','block');
                $('#otp_error').text('Wrong OTP');
            });

    }

</script>
