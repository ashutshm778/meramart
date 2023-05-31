@extends('backend.include.header')
<style>
    .card-header {
        text-align: center;
        padding: 0.5rem 0.5rem !important;
    }
</style>
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
                                    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['admin.roles.update', $role->id]]) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group" style="margin: 10px;">
                                                <strong>Name:</strong>
                                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                @foreach ($permission as $value)
                                                    {{-- <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                                        {{ $value->name }}</label>
                                                    <br /> --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="card card-outline card-info">
                                                                <div class="card-header">
                                                                    <strong>{{ $value->parent_name }}</strong>
                                                                </div>
                                                                <div class="card-body crd-vrflw">
                                                                    @php
                                                                        $parent_permissions = \Spatie\Permission\Models\Permission::where('parent_id', $value->parent_id)->get();
                                                                        $selected_permission = DB::table('role_has_permissions')->where('role_id', $role->id)->pluck('permission_id');
                                                                    @endphp
                                                                    @foreach ($parent_permissions as $parent_permission)
                                                                        <div class=" row col-md-12">
                                                                            <div class="col-md-9">
                                                                                {{ ucwords(str_replace('-', ' ', $parent_permission->name)) }}
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <div class="custom-control custom-switch">
                                                                                        <input type="checkbox" name="permission[]" value="{{ $parent_permission->id }}" class="custom-control-input" id="{{ $parent_permission->id }}" @if(in_array($parent_permission->id, $selected_permission->toArray())) checked @endif>
                                                                                        <label class="custom-control-label" for="{{ $parent_permission->id }}"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
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
