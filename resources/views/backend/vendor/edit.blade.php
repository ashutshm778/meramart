@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.vendors.index')}}">Vendor List</a></li>
                            <li class="breadcrumb-item active">Add Vendor</li>
                        </ol>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    <form action="{{route('admin.vendors.update',$vendor->id)}}" method="POST" class="form-example">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="owner_name">Owner Name</label>
                                                        <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{$vendor->owner_name}}" placeholder="Enter Owner Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="business_name">Business Name</label>
                                                        <input type="text" class="form-control" id="business_name" name="business_name" value="{{$vendor->business_name}}" placeholder="Enter Business Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="number" class="form-control" id="phone" name="phone" value="{{$vendor->phone}}" placeholder="Enter Phone..." required>
                                                        @if ($errors->has('phone'))
                                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="contact_name">Contact Name</label>
                                                        <input type="text" class="form-control" id="contact_name" name="contact_name" value="{{$vendor->contact_name}}" placeholder="Enter Contact Name...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="{{$vendor->email}}" placeholder="Enter Email...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="gstin">GSTIN</label>
                                                        <input type="text" class="form-control" id="gstin" name="gstin" value="{{$vendor->gstin}}" placeholder="Enter GSTIN...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" id="address" name="address" value="{{$vendor->address}}" placeholder="Enter Address...">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 form_div text-center">
                                                    <div class="form-group">
                                                        <h1>Account Details</h1>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="account_holder_name">Holder Name</label>
                                                        <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" value="{{$vendor->account_holder_name}}" placeholder="Enter Holder Name...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="account_number">Account Number</label>
                                                        <input type="text" class="form-control" id="account_number" name="account_number" value="{{$vendor->account_number}}" placeholder="Enter Account Number...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="ifsc_code">IFCS Code</label>
                                                        <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" value="{{$vendor->ifsc_code}}" placeholder="Enter IFCS Code...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="branch_name">Branch Name</label>
                                                        <input type="text" class="form-control" id="branch_name" name="branch_name" value="{{$vendor->branch_name}}" placeholder="Enter Branch Name...">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Update this Vendor?');"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

