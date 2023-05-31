@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.categories.index')}}">Category List</a></li>
                            <li class="breadcrumb-item active">Edit Category</li>
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
                                    <form action="{{route('admin.categories.update',$category->id)}}" method="POST" class="form-example">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" placeholder="Enter Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="commision">Commision</label>
                                                        <input type="number" step='0.01' class="form-control" id="commision" name="commision" value="{{$category->commision}}" placeholder="Enter commision..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Icon</label>
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                            <div class="form-control file-amount">Choose Icon</div>
                                                            <input type="hidden" name="icon" class="selected-files" value="{{$category->icon}}">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                            </div>
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Banner</label>
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                            <div class="form-control file-amount">Choose Banner</div>
                                                            <input type="hidden" name="banner" class="selected-files" value="{{$category->banner}}">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                            </div>
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control summernote" name="description">{!!$category->descrption!!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="meta_name">Meta Name</label>
                                                        <input type="text" class="form-control" id="meta_name" name="meta_name" value="{{$category->meta_name}}" placeholder="Enter Meta Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="meta_description">Meta Description</label>
                                                        <textarea class="form-control summernote" name="meta_description" required>{!!$category->meta_descrption!!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Save this category?');"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
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
