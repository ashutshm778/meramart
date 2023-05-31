@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Sales Member</li>
                        </ol>
                    </div>
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

                                    <form action="{{route('admin.sales.team.store')}}" method="POST" id="form" class="form-example">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" name="first_name" class="form-control" placeholder="First Name..." required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="middle_name">Middle Name</label>
                                                    <input type="text" name="middle_name" class="form-control" placeholder="Middle Name...">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name..." required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dob">DOB</label>
                                                    <input type="date" name="dob" class="form-control" max="{{Carbon\Carbon::now()->subYears(12)->format('Y-m-d')}}" placeholder="DOB...">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="number" name="phone" class="form-control" placeholder="Phone..." required>
                                                </div>
                                                <span id="phone_error" style="color:red;display:none">* This Phone Already Exists!</span>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Email...">
                                                </div>
                                                <span id="email_error" style="color:red;display:none">* This Email Already Exists!</span>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="gender">Gender</label>
                                                    <select name="gender" class="form-control">
                                                        <option value="">Select Gender...</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="password">Password</label>
                                                <div class="form-label-group input-group mb-3">
                                                    <input type="password" id="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i id="eye" class="far fa-eye-slash" onclick="showHidePwd();"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="password">Confirm Password</label>
                                                <div class="form-label-group input-group mb-3">
                                                    <input type="password" id="confirm_password" id="confirm_password" name="confirm-password" class="form-control" placeholder="Password" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i id="eyes" class="far fa-eye-slash" onclick="showHidePwds();"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <span id="password_error" style="color:red;display:none">* Confirm Password Not Matched!</span>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="adhar_number">Adhar Number</label>
                                                    <input type="text" name="adhar_number" class="form-control" placeholder="Adhar Number...">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Adhar Front Image</label>
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                        <div class="form-control file-amount">Choose Adhar Front Image</div>
                                                        <input type="hidden" name="adhar_front_image" class="selected-files" value="">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                        </div>
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Adhar Back Image</label>
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                        <div class="form-control file-amount">Choose Adhar Back Image</div>
                                                        <input type="hidden" name="adhar_back_image" class="selected-files" value="">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                        </div>
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="pan_number">Pan Number</label>
                                                    <input type="text" name="pan_number" class="form-control" placeholder="Pan Number...">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Pan Image</label>
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                        <div class="form-control file-amount">Choose Pan Image</div>
                                                        <input type="hidden" name="pan_image" class="selected-files" value="">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                        </div>
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Profile Image</label>
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                        <div class="form-control file-amount">Choose Profile Image</div>
                                                        <input type="hidden" name="profile_image" class="selected-files" value="">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                        </div>
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="marital_status">Marital Status</label>
                                                    <select name="marital_status" class="form-control">
                                                        <option value="">Select Marital Status...</option>
                                                        <option value="single">Single</option>
                                                        <option value="married">Married</option>
                                                        <option value="widow_widower">Widow / Widower</option>
                                                        <option value="divorced">Divorced</option>
                                                        <option value="separated">Separated</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea name="address" class="form-control" placeholder="Address..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>Qualification Detailes <a class="btn btn-primary" onclick="add_qualification_details()"><i class="fa fa-plus"></i></a></h4>
                                            </div>
                                            <div class="col-md-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Qualification</th>
                                                            <th>University</th>
                                                            <th>Institute Name</th>
                                                            <th>Year Of Passing</th>
                                                            <th>Percentage</th>
                                                            <th>Marks Memo</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                        <tr class="tr_class"></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>Experience Detailes <a class="btn btn-primary" onclick="add_experience_details()"><i class="fa fa-plus"></i></a></h4>
                                            </div>
                                            <div class="col-md-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Institute Name</th>
                                                            <th>Designation</th>
                                                            <th>From Date</th>
                                                            <th>To Date</th>
                                                            <th>Year Of Exp.</th>
                                                            <th>Starting Salary</th>
                                                            <th>Ending Salary</th>
                                                            <th>Attachment</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_bodys">
                                                        <tr class="tr_classs"></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <button type="button" class="btn btn-outline-success mt-1 mb-1" onclick="save()">Save</button>
                                            </div>
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

<script src="{{ asset('public/dashboard_css/plugins/jquery/jquery.min.js') }}"></script>
<script>
    function showHidePwd()
    {
        var input = document.getElementById("password");
        if (input.type === "password")
        {
            input.type = "text";
            document.getElementById("eye").className = "far fa-eye";
        }
        else
        {
            input.type = "password";
            document.getElementById("eye").className = "far fa-eye-slash";
        }
    }

    function showHidePwds()
    {
        var input = document.getElementById("confirm_password");
        if (input.type === "password")
        {
            input.type = "text";
            document.getElementById("eyes").className = "far fa-eye";
        }
        else
        {
            input.type = "password";
            document.getElementById("eyes").className = "far fa-eye-slash";
        }
    }

    function add_qualification_details()
    {
        $('#table_body').append('<tr class="tr_class">'+
                                    '<td>'+
                                        '<input type="text" name="qualification[]" class="form-control" placeholder="Qualification..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="text" name="university[]" class="form-control" placeholder="University..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="text" name="institute_name[]" class="form-control" placeholder="Institute Name..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="number" name="year_of_passing[]" min="{{Carbon\Carbon::now()->subYear(100)->format("Y")}}" max="{{Carbon\Carbon::now()->format("Y")}}" step="1"  class="form-control" placeholder="Year Of Passing..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="number" step="0.01" name="percentage[]" class="form-control" placeholder="Percentage..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="number" name="marks_memo[]" class="form-control" placeholder="Marks Memo..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<a class="btn btn-danger deleter"><i class="fa fa-trash"></i></a>'+
                                    '</td>'+
                                '</tr>');
    }

    $(document).on('click', '.deleter',function(){
        $(this).closest('.tr_class').remove();
    });

    function add_experience_details()
    {
        $('#table_bodys').append('<tr class="tr_classs">'+
                                    '<td>'+
                                        '<input type="text" name="institute_name_exp[]" class="form-control" placeholder="Institute Name..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="text" name="designation[]" class="form-control" placeholder="Designation..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="date" name="from_date[]" max="{{date("Y-m-d")}}" class="form-control" placeholder="From Date..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="date" name="to_date[]"  max="{{date("Y-m-d")}}" class="form-control" placeholder="To Date..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="number" step="0.1" name="Year_of_exp[]" class="form-control" placeholder="Year Of Exp...." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="number" name="starting_salary[]" class="form-control" placeholder="Starting Salary..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<input type="number" name="ending_salary[]" class="form-control" placeholder="Ending Salary..." required>'+
                                    '</td>'+
                                    '<td>'+
                                        '<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">'+
                                            '<input type="hidden" name="attachment[]" class="selected-files" value="" required>'+
                                            '<div class="input-group-prepend">'+
                                                '<div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="file-preview box sm"></div>'+
                                    '</td>'+
                                    '<td>'+
                                        '<a class="btn btn-danger deleters"><i class="fa fa-trash"></i></a>'+
                                    '</td>'+
                                '</tr>');
    }

    $(document).on('click', '.deleters',function(){
        $(this).closest('.tr_classs').remove();
    });

    function save()
    {
        var validation = $("#form").valid();
        if (validation) {
            var password=$('#password').val();
            var confirm_password=$('#confirm_password').val()
            if(password == confirm_password)
            {
                $('#password_error').hide()
                    var formData = new FormData($("#form")[0]);
                    $.ajax({
                        url: '{{ route('admin.sales.team.store') }}',
                        data: formData,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            window.location.replace("{{route('admin.sales.team.index')}}");
                        },
                        error: function (request, status, error) {
                            $(window).scrollTop(0);
                            if(request.responseJSON.errors.phone){
                                $('#phone_error').show()
                                $('#email_error').hide()
                            }
                            if(request.responseJSON.errors.email){
                                $('#phone_error').hide()
                                $('#email_error').show()
                            }
                        }
                    })
            }
            else
            {
                $(window).scrollTop(0);
                $('#password_error').show()
            }
        }
        else
        {
            $(window).scrollTop(0);
            return false;
        }
    }

</script>
