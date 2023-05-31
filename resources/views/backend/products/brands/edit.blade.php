@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.brands.index')}}">Brand List</a></li>
                            <li class="breadcrumb-item active">Edit Brand</li>
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
                                    <form action="{{route('admin.brands.update',$brnad->id)}}" method="POST" class="form-example">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{$brnad->name}}" placeholder="Enter Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Icon</label>
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                            <div class="form-control file-amount">Choose Icon</div>
                                                            <input type="hidden" name="icon" class="selected-files" value="{{$brnad->icon}}">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                            </div>
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" style="padding-top:25px">
                                                        <button type="button" class="btn btn-primary" onclick="addDiv()"><i class="fa fa-plus"></i> Add Category Image</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="cat_div">
                                                @foreach($brnad->cat_id as $key=>$cat)
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <select name="cat_id[]" class="form-control select2" required>
                                                                <option value="">Select Category...</option>
                                                                @foreach (App\Models\Admin\Category::where("is_active",1)->get() as $category)
                                                                    <option value="{{$category->id}}" @if($cat == $category->id) selected @endif>{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Icon</label>
                                                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                                <div class="form-control file-amount">Choose Icon</div>
                                                                <input type="hidden" name="cat_img[]" class="selected-files" value="{{$brnad->cat_img[$key]}}">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                                </div>
                                                            </div>
                                                            <div class="file-preview box sm"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group" style="padding-top:30px">
                                                            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form_div">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control summernote" name="description">{!!$brnad->descrption!!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="meta_name">Meta Name</label>
                                                        <input type="text" class="form-control" id="meta_name" name="meta_name" value="{{$brnad->meta_name}}" placeholder="Enter Meta Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="meta_description">Meta Description</label>
                                                        <textarea class="form-control summernote" name="meta_description">{!!$brnad->meta_descrption!!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Save this brand?');"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
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

    function addDiv(){
        $('#cat_div').append('<div class="col-md-2">'+
                                '<div class="form-group">'+
                                    '<label>Category</label>'+
                                    '<select name="cat_id[]" class="form-control select2" required>'+
                                        '<option value="">Select Category...</option>'+
                                        '@foreach (App\Models\Admin\Category::where("is_active",1)->get() as $category)'+
                                            '<option value="{{$category->id}}">{{$category->name}}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<div class="form-group">'+
                                    '<label>Icon</label>'+
                                    '<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">'+
                                        '<div class="form-control file-amount">Choose Icon</div>'+
                                        '<input type="hidden" name="cat_img[]" class="selected-files" value="">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="file-preview box sm"></div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-1">'+
                                '<div class="form-group" style="padding-top:30px">'+
                                    '<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>'+
                                '</div>'+
                            '</div>');
        $('.select2').select2();

    }

</script>
