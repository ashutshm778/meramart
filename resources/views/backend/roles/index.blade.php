@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Role Management</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @can('role-create')
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-success float-right"> Create New Role <i
                                    class="fas fa-plus"></i></a>
                        @endcan
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Role Management</h3>
                            </div>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        @canany(['role-show','role-edit','role-delete'])<th width="280px">Action</th>@endcan
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $role->name }}</td>
                                            @canany(['role-show','role-edit','role-delete'])
                                                <td>
                                                    @can('role-show')
                                                        <a class="btn btn-outline-info btn-sm mr-1 mb-1 mt-1"
                                                            href="{{ route('admin.roles.show', $role->id) }}"><i
                                                                class="fas fa-eye"></i></a>
                                                    @endcan
                                                    @can('role-edit')
                                                        <a class="btn btn-outline-primary btn-sm mr-1 mb-1 mt-1"
                                                            href="{{ route('admin.roles.edit', $role->id) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('role-delete')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                        {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>


                                {!! $roles->render() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
