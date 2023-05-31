@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Attribtue List</li>
                        </ol>
                    </div>
                        <div class="col-sm-6">
                            @php
                                if($search_category)
                                {
                                    if(is_array($search_category))
                                    {
                                        $search_category=json_encode($search_category);
                                    }
                                }
                            @endphp
                            <a href="{{ route('admin.attributes.create').'?key='.$search.'&search_category_id='.$search_category.'&page='.$list->currentPage() }}" class="btn btn-success float-right"> Add Attribute <i class="fas fa-plus"></i></a>
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
                                <div class="row">
                                <div class="col-md-2">
                                <h3 class="card-title">Attribtue List</h3>
                                </div>
                                <div class="col-md-10">
                                    <form action="{{route('admin.attributes.index')}}">
                                        <div class="col-md-12">
                                            <div class="row" style="justify-content: end;">
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-sm">
                                                        <select name="search_category_id[]" id="search_category_id" class="form-control select2" data-placeholder="Select Category" multiple>
                                                                @foreach (App\Models\Admin\Category::orderBy('priority','asc')->get() as $category)
                                                                    <option value="{{$category->id}}" @isset($search_category) @if(in_array($category->id,json_decode($search_category))) selected @endif @endisset>{{$category->name}}</option>
                                                                @endforeach
                                                        </select>
                                                        </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="key" value="{{$search}}" class="form-control float-right" placeholder="Search">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-default">
                                                                <i class="fas fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Value</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td class="text-center">{{$data->name}}</td>
                                                <td class="text-center">{{implode('/',$data->value)}}</td>
                                                <td class="text-center">
                                                    @foreach($data->category_id as $cat)
                                                        {{App\Models\Admin\Category::where('id',$cat)->first()->name}} <br>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.attributes.edit',$data->id).'?key='.$search.'&search_category_id='.$search_category.'&page='.$list->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.attributes.destroy',$data->id).'?key='.$search.'&search_category_id='.$search_category.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to delete this attribute?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="footable-empty">
                                                <td colspan="11">
                                                <center style="padding: 70px;"><i class="far fa-frown" style="font-size: 100px;"></i><br><h2>Nothing Found</h2></center>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {!! $list->appends(['key'=>$search,'search_category_id'=>$search_category])->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
