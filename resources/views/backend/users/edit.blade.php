@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users Management</li>
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
                                    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['admin.users.update', $user->id]]) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Name:</strong>
                                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Email:</strong>
                                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            {{-- <div class="form-group">
                                                <strong>Password:</strong>
                                                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                                            </div> --}}
                                            <strong>Password:</strong>
                                            <div class="form-label-group input-group mb-3">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i id="eye" class="far fa-eye-slash" onclick="showHidePwd();"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            {{--  <div class="form-group">
                                                <strong>Confirm Password:</strong>
                                                {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                                            </div> --}}
                                            <strong>Confirm Password:</strong>
                                            <div class="form-label-group input-group mb-3">
                                                <input type="password" id="confirm_password" name="confirm-password" class="form-control" placeholder="Password">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i id="eye" class="far fa-eye-slash" onclick="showHidePwds();"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group ">
                                                <strong>Role:</strong>
                                                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control select2', 'multiple']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
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
        function showHidePwd() {
        var input = document.getElementById("password");
        if (input.type === "password") {
            input.type = "text";
            document.getElementById("eye").className = "far fa-eye";
        } else {
            input.type = "password";
            document.getElementById("eye").className = "far fa-eye-slash";
        }
    }

    function showHidePwds() {
    var input = document.getElementById("confirm_password");
    if (input.type === "password") {
        input.type = "text";
        document.getElementById("eyes").className = "far fa-eye";
    } else {
        input.type = "password";
        document.getElementById("eyes").className = "far fa-eye-slash";
    }
   }
    </script>

