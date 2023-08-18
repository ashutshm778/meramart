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
                <div class="col-md-1"></div>
                <div class="col-md-10">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="image-contain d-lg-block d-md-block d-none">
                            <img src="{{asset('public/frontend/assets/images/login.jpeg')}}" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ec-register-wrapper">
                            <div class="ec-register-container">
                                <div class="ec-register-form">
                                    <form id="valid_form" action="{{route('customer.login')}}" method="post">
                                        @csrf
                                        <span class="ec-register-wrap col-md-12">
                                            <label>Phone Number<span style="color:red">*<span></label> <br>
                                            <input type="number" class="form-control" id="phone" name="phone" value="{{old('phone')}}" placeholder="" required>
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </span>

                                        <span class="ec-register-wrap col-md-12">
                                            <label>Password<span style="color:red">*<span></label> <br>
                                            <input type="password" id="pasword" class="form-control" name="password" placeholder="" required />
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </span>
                                        <div class="row w-100">
                                            <div class="col-md-6">
                                                <div class="agree-label">
                                                    <input type="checkbox" name="remember">
                                                    <label for="chb1">Remember Me </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <p class="mt-2"><i class="ecicon eci-lock"></i> Forget Password ? <a href="{{ route('customer.forgot_password') }}"> Click Here</a></p>
                                           </div>
                                        </div>
                                        <span class="ec-register-wrap ec-register-btn">
                                            <button class="btn btn-primary" type="submit">Login</button>

                                            <div class="row">
                                                <div class="col-md-12">
                                                  <p style="text-align: center;">Don't have an account? </p>

                                                    <div class="social-option">
                                                        <h3>Register Here</h3>
                                                            <ul>
                                                                {{-- <li><a href="{{ route('user.register') }}"> As User</a></li> --}}
                                                                <li><a href="{{ route('user.register.mlm') }}"> As User</a></li>
                                                            </ul>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6">
                                                    <p class="mt-2">Don't have an account ?  <a href="{{ route('user.register.mlm') }}"> Register</a></p>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                     <p class="mt-2">Forget Password ? <a href="{{ route('customer.forgot_password') }}"> Click Here</a></p>
                                                </div> --}}
                                            </div>
                                        </span>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>

@endsection
