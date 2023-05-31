@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Brand List</li>
                        </ol>
                    </div>
                        <div class="col-sm-6">
                            <a href="{{ route('admin.brands.create').'?key='.$search.'&page='.$list->currentPage() }}" class="btn btn-success float-right"> Add Brand <i class="fas fa-plus"></i></a>
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
                                <h3 class="card-title">Brand List</h3>
                                <div class="card-tools">
                                    <form action="{{route('admin.brands.index')}}">
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
                                            <th class="text-center" style="width: 14%;">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Icon</th>
                                            <th class="text-center">Is Active</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td class="text-center">{{$data->name}}</td>
                                                <td class="text-center"><img src="{{asset('public/'.api_asset($data->icon))}}" style="height:100px;"></td>
                                                <td class="text-center">
                                                    @if($data->is_active)
                                                        <a href="{{route('admin.brands.show',$data->id).'?is_active=0&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to deactive this brand?');"><span class="badge bg-success">Actived</span></a>
                                                    @else
                                                        <a href="{{route('admin.brands.show',$data->id).'?is_active=1&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to active this brand?');"><span class="badge bg-danger">Deactived</span></a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.brands.edit',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.brands.destroy',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to delete this brand?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
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
