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
                    <div class="col-sm-6">
                        @can('user-create')
                            <a href="{{ route('admin.users.create') }}" class="btn btn-success float-right"> Create New User <i class="fas fa-plus"></i></a>
                        @endcan
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Users Management</h3>
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
                                        <th>Email</th>
                                        <th>Roles</th>
                                        @canany(['user-edit','user-show','user-delete'])<th width="280px">Action</th>@endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            @canany(['user-edit','user-show','user-delete'])
                                                <td>
                                                    @can('user-show')
                                                        <a class="btn btn-outline-info btn-sm mr-1 mb-1 mt-1" href="{{ route('admin.users.show', $user->id) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endcan
                                                    @can('user-edit')
                                                        <a class="btn btn-outline-primary btn-sm mr-1 mb-1 mt-1" href="{{ route('admin.users.edit', $user->id) }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('user-delete')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                                        <button type="submit" class='btn btn-outline-danger btn-sm'><i class="fas fa-trash"></i></button>
                                                        {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!} --}}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>


                                {!! $data->render() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
