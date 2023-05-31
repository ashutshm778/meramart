@extends('backend.include.header')
@section('content')

<style>

.sub-cat
{
    list-style: none;
    margin: 0;
    padding: 0;

}

.sub-cat li
{

    width: 19.6%;
    display: inline-block;
}

</style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Low Stock Product List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Categories</th>
                                            <th class="text-center">Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td class="text-center">
                                                    <img src="{{asset('public/'.api_asset($data->thumbnail_image))}}" style="height:80px;width: 80px;margin-right: 10px;">
                                                </td>
                                                <td class="text-left">
                                                    {{$data->name}} <br>
                                                    @if($data->hsn_code)
                                                        <b>HSN:</b> {{$data->hsn_code}}
                                                    @endif
                                                </td>
                                                <td class="text-left"><b>MC:</b>
                                                    @foreach ($data->category_id as $category)
                                                        {{App\Models\Admin\Category::where('id',$category)->first()->name}}/
                                                    @endforeach <br>
                                                    <b>S.C:</b>
                                                    @foreach ($data->subcategory_id as $subcategory)
                                                        {{App\Models\Admin\SubCategory::where('id',$subcategory)->first()->name}}/
                                                    @endforeach <br>
                                                    @if($data->subsubcategory_id)
                                                        <b>S.S.C:</b>
                                                        @foreach ($data->subsubcategory_id as $subsubcategory)
                                                            {{App\Models\Admin\SubSubCategory::where('id',$subsubcategory)->first()->name}}/
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="text-left">
                                                    <b>Available:</b> {{$data->current_stock}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="footable-empty">
                                                <td colspan="15">
                                                <center style="padding: 70px;"><i class="far fa-frown" style="font-size: 100px;"></i><br><h2>Nothing Found</h2></center>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {!! $list->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
