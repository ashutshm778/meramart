@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Category List</li>
                        </ol>
                    </div>
                        <div class="col-sm-6">
                            <a href="{{ route('admin.categories.create').'?key='.$search.'&page='.$list->currentPage() }}" class="btn btn-success float-right"> Add Category <i class="fas fa-plus"></i></a>
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
                                <h3 class="card-title">Category List</h3>
                                <a class="btn btn-primary" style="margin-left: 15%;" onclick="manage_category('nav')">Manage Nav Category</a>
                                <a class="btn btn-primary" onclick="manage_category('top')">Manage Top Category</a>
                                <a class="btn btn-primary" onclick="manage_category('bottom')">Manage Bottom Category</a>
                                <div class="card-tools">
                                    <form action="{{route('admin.categories.index')}}">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input type="text" name="key" value="{{$search}}" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 14%;">Priority <br><span style="color:red;font-size: 12px;">(Double Click To Change)</span></th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Icon</th>
                                            <th class="text-center">Is Feature</th>
                                            <th class="text-center">Is Active</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center" id="{{$data->id}}" @can('category-edit') ondblclick="change_priority({{$data->id}})" @endcan>{{$data->priority}}</td>
                                                <td class="text-center">{{$data->name}}</td>
                                                <td class="text-center"><img src="{{asset('public/'.api_asset($data->icon))}}" style="height:100px;"></td>
                                                <td class="text-center">
                                                    @if($data->is_feature)
                                                        <a href="{{route('admin.categories.feature',$data->id).'?is_feature=0&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to not Feature this category?');"><span class="badge bg-success">Featured</span></a>
                                                    @else
                                                        <a href="{{route('admin.categories.feature',$data->id).'?is_feature=1&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to Feature this category?');"><span class="badge bg-danger">Not Featured</span></a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($data->is_active)
                                                        <a href="{{route('admin.categories.show',$data->id).'?is_active=0&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to deactive this category?');"><span class="badge bg-success">Actived</span></a>
                                                    @else
                                                        <a href="{{route('admin.categories.show',$data->id).'?is_active=1&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to active this category?');"><span class="badge bg-danger">Deactived</span></a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.categories.edit',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.categories.destroy',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to delete this category?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
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
                                    {!! $list->appends(['key'=>$search])->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="modal_title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body" id="table">
            @include('backend.products.categories.table')
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default text-center" data-dismiss="modal">Close</button>
        </div>
        </div>

        </div>

        </div>

@endsection

<script>

    function change_priority(id)
    {
        var priority=$('#'+id).text();
        $('#'+id).html('<input type="number" class="form-control d-flex justify-content-center" name="priority" id="priority_value'+id+'" onchange="update_priority('+id+')" value="'+priority+'" style="width:100px;margin-left: auto;margin-right: auto;">');
    }

    function update_priority(id)
    {
        var value=$('#priority_value'+id).val();
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.categories.priority') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                value: value
            },
            success: function(data) {
                if(data == 1)
                {
                    url='{{route("admin.categories.index")}}?prio=prio'
                    window.location.href = url;
                }
                else
                {
                    alert('Incorrect Priority Number.')
                }
            }
        });
    }

</script>
<script>
    function manage_category(type)
    {
        $.get("{{route('admin.category.priority.data','')}}"+"/"+type, function(data)
        {
            $('#table').html(data);
            var text = type.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            $('#modal_title').text('Manage '+text+' Category')
            $('#modal-default').modal('show');
        });
    }
</script>
