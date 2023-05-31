@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.sub-categories.index')}}">Business Person Request List</a></li>
                            <li class="breadcrumb-item active">Edit Business Person Request</li>
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
                                    <form action="{{route('admin.business.person.request.update',$data->id)}}" method="POST" class="form-example" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="search_type" value="{{$type}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$data->first_name}}" placeholder="Enter First Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$data->last_name}}" placeholder="Enter Last Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="number" class="form-control" id="phone" name="phone" value="{{$data->phone}}" placeholder="Enter Phone..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" placeholder="Enter Email..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="type">Type</label>
                                                        <input type="text" class="form-control" id="type" name="type" value="{{ucwords($data->type)}}" required readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="business_name">Business Name</label>
                                                        <input type="text" class="form-control" id="business_name" name="business_name" value="{{$data->business_name}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="brand_name">Brand Name</label>
                                                        <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{$data->brand_name}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="owner_name">Owner Name</label>
                                                        <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{$data->owner_name}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="gstin_number">GSTIN Number</label>
                                                        <input type="text" class="form-control" id="gstin_number" name="gstin_number" value="{{$data->gstin_number}}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="form-group">
                                                        <label for="gstin_document">GSTIN Document</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" accept="image/*" class="custom-file-input" id="gstin_document" onchange="loadFile(event)" name="gstin_document">
                                                                <label class="custom-file-label" for="gstin_document">GSTIN Document</label>
                                                                <div class="fakefile"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <span class="form-control-custom">
                                                        <label></label>
                                                        <a href="{{asset('public/public/gstin_documents/'.$data->gstin_document)}}" target="_blank"><img src="{{asset('public/public/gstin_documents/'.$data->gstin_document)}}" id="output" style="width: 150px;height: 150px;"/></a>
                                                    </span>
                                                </div>
                                                <div class="col-md-3 form_div">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" id="address" name="address" value="{{$data->address}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form_div">
                                                    <div class="form-group">
                                                        <label for="verify_status">Verify Status</label>
                                                        <select name="verify_status" id="verify_status" class="form-control">
                                                            <option value="0" @if($data->verify_status == 0) selected @endif>Pending</option>
                                                            <option value="1" @if($data->verify_status == 1) selected @endif>Approved</option>
                                                            <option value="2" @if($data->verify_status == 2) selected @endif>Cancel</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Update this details?');"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
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

<script>
    function ClearFields() {
        document.getElementById("company_logo").value = "";
        document.getElementById("output").src = "https://trustkaro.com/public/select.png";
    }
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
