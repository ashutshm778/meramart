@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">SubSubCategory List</li>
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
                                if($search_subcategory)
                                {
                                    if(is_array($search_subcategory))
                                    {
                                        $search_subcategory=json_encode($search_subcategory);
                                    }
                                }
                            @endphp
                            <a href="{{ route('admin.sub-sub-categories.create').'?key='.$search.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$list->currentPage() }}" class="btn btn-success float-right"> Add SubSubCategory <i class="fas fa-plus"></i></a>
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
                                <h3 class="card-title">SubSubCategory List</h3>
                                </div>
                                <div class="col-md-10">
                                    <form action="{{route('admin.sub-sub-categories.index')}}">
                                        <div class="col-md-12">
                                            <div class="row" style="justify-content: end;">
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-sm">
                                                        <select name="search_category_id[]" id="search_category_id" class="form-control select2" data-placeholder="Select Category" multiple onchange="get_sub_categories()">
                                                                @foreach (App\Models\Admin\Category::orderBy('priority','asc')->get() as $category)
                                                                    <option value="{{$category->id}}" @isset($search_category) @if(in_array($category->id,json_decode($search_category))) selected @endif @endisset>{{$category->name}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-sm">
                                                        <select name="search_subcategory_id[]" id="search_subcategory_id" class="form-control select2" data-placeholder="Select SubCategory" multiple></select>
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
                                            <th class="text-center">Category</th>
                                            <th class="text-center">SubCategory</th>
                                            <th class="text-center">Is Active</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td class="text-center">{{$data->name}}</td>
                                                <td class="text-center">
                                                    @foreach($data->category_id as $cat)
                                                        {{App\Models\Admin\Category::where('id',$cat)->first()->name}} <br>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @foreach($data->subcategory_id as $subcat)
                                                        {{App\Models\Admin\SubCategory::where('id',$subcat)->first()->name}} <br>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @if($data->is_active)
                                                        <a href="{{route('admin.sub-sub-categories.show',$data->id).'?is_active=0&key='.$search.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to deactive this subsubcategory?');"><span class="badge bg-success">Actived</span></a>
                                                    @else
                                                        <a href="{{route('admin.sub-sub-categories.show',$data->id).'?is_active=1&key='.$search.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to active this subsubcategory?');"><span class="badge bg-danger">Deactived</span></a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.sub-sub-categories.edit',$data->id).'?key='.$search.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$list->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.sub.sub.categories.destroy',$data->id).'?key='.$search.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to delete this subsubcategory?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
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
                                    {!! $list->appends(['key'=>$search,'search_category_id'=>$search_category,'search_subcategory_id'=>$search_subcategory])->links() !!}
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

    $(setTimeout(function () {get_sub_categories()}, 200));
    function get_sub_categories()
    {
        var sub_cat="{{$search_subcategory}}";
        var category_ids=$('#search_category_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('admin.get.sub.categories.by.category')}}",
            data:{
                category_ids:category_ids
            },
            success: function(data) {
                $('#search_subcategory_id').empty();
                $.each(data, function(key, val) {
                    test= sub_cat.includes(''+val.id);
                    $('#search_subcategory_id').append('<option value="'+ val.id +'" '+(test ? "selected" : "")+'  >'+ val.name +'</option>');
                });
            }
        });
    }

</script>
