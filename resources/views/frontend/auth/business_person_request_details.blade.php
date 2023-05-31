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
                                <li class="ec-breadcrumb-item active">Business Person Request Details</li>
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
                        <img src="{{asset('public/frontend/assets/images/log-in.png')}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="ec-register-wrapper col-md-7">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            Your Data Has Been Successfully Saved!
                        </div>
                    @endif
                    <div class="ec-register-container">
                        <div class="ec-register-form">
                            <form action="{{route('business.person.request.details.save')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @php
                                    if(session()->has('message'))
                                    {
                                        $request_id=session()->get('message');
                                    }
                                    else
                                    {
                                        header("Location: " . URL::to('/business-person-request-form'));
                                        exit();
                                    }
                                @endphp
                                <input type="hidden" name="request_id" value="{{$request_id}}">
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Brand Name<span style="color:red">*<span></label> <br>
                                    <input type="text" class="form-control" name="brand_name" value="{{old('brand_name')}}" placeholder="Enter Brand Name..." required />
                                    @if ($errors->has('brand_name'))
                                        <span class="text-danger">{{ $errors->first('brand_name') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap ec-register-half">
                                    <label>Owner Name<span style="color:red">*<span></label> <br>
                                    <input type="text" class="form-control" name="owner_name" value="{{old('owner_name')}}" placeholder="Enter Owner Name..." required />
                                    @if ($errors->has('owner_name'))
                                        <span class="text-danger">{{ $errors->first('owner_name') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap ec-register-half">
                                    <label>GSTIN Number<span style="color:red">*<span></label> <br>
                                    <input type="text" class="form-control" name="gst_number" value="{{old('gst_number')}}" placeholder="Enter Your GSTIN Number..." required />
                                    @if ($errors->has('gst_number'))
                                        <span class="text-danger">{{ $errors->first('gst_number') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap ec-register-half">
                                    <label>GSTIN Document<span style="color:red">*<span></label> <br>
                                    <input type="file" class="form-control" id="gst_document" name="gst_document" value="{{old('gst_document')}}" required>
                                </span>

                                <span class="ec-register-wrap ec-register-half">
                                    <label>Email<span style="color:red">*<span></label> <br>
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Enter Your email..." required />
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap ec-register-half">
                                    <label>Address<span style="color:red">*<span></label> <br>
                                    <input type="text" id="address" class="form-control" name="address" placeholder="Enter Your Address..." required />
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap ec-register-btn">
                                    <button class="btn btn-primary" type="submit">Save Detail</button>
                                </span>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
