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
                            <li class="breadcrumb-item active">Product List</li>
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
                                if($search_subsubcategory)
                                {
                                    if(is_array($search_subsubcategory))
                                    {
                                        $search_subsubcategory=json_encode($search_subsubcategory);
                                    }
                                }
                                if($search_brand)
                                {
                                    if(is_array($search_brand))
                                    {
                                        $search_brand=json_encode($search_brand);
                                    }
                                }
                            @endphp
                            <a href="{{ route('admin.products.create').'?key='.$search.'&search_category_id='.$search_category.'&search_subcategory_id='.$search_subcategory.'&search_subsubcategory_id='.$search_subsubcategory.'&search_brand_id='.$search_brand.'&page='.$list->currentPage() }}" class="btn btn-success float-right"> Add Product <i class="fas fa-plus"></i></a>
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
                                <div class="col-md-12">
                                    <form action="{{route('admin.products.index')}}">
                                        <ul class="sub-cat">
                                            <li>
                                                <div class="input-group input-group-sm">
                                                    <select name="search_category_id[]" id="search_category_id" class="form-control select2" data-placeholder="Select Category" multiple onchange="get_sub_categories()">
                                                        @foreach (App\Models\Admin\Category::orderBy('priority','asc')->get() as $category)
                                                            <option value="{{$category->id}}" @isset($search_category) @if(in_array($category->id,json_decode($search_category))) selected @endif @endisset>{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="input-group input-group-sm">
                                                    <select name="search_subcategory_id[]" id="search_subcategory_id" class="form-control select2" data-placeholder="Select SubCategory" multiple onchange="get_sub_sub_categories()"></select>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="input-group input-group-sm">
                                                    <select name="search_subsubcategory_id[]" id="search_subsubcategory_id" class="form-control select2" data-placeholder="Select SubSubCategory" multiple></select>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="input-group input-group-sm">
                                                    <select name="search_brand_id" id="search_brand_id" class="form-control select2" data-placeholder="Select Brand">
                                                        <option value="">Select Brand...</option>
                                                        @foreach (App\Models\Admin\Brnad::orderBy('name','asc')->get() as $brand)
                                                            <option value="{{$brand->id}}" @isset($search_brand) @if($brand->id==$search_brand) selected @endif @endisset>{{$brand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="key" value="{{$search}}" class="form-control" placeholder="Search">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Categories</th>
                                            @if(featureActivation('purchase_vendor') == '1')
                                                <th class="text-center">Stock</th>
                                            @endif
                                            {{-- <th class="text-center">Price</th>
                                            <th class="text-center">Point</th> --}}
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td class="text-center">
                                                    <img src="{{asset('public/'.api_asset($data->thumbnail_image))}}" style="height:80px;">
                                                </td>
                                                <td class="text-left">
                                                    <b>Name: </b><a href="{{route('search',$data->slug)}}?type=product" target="_blank">{{$data->name}}</a>
                                                    <br>
                                                    @if($data->hsn_code != null)
                                                        <b>HSN:</b> {{$data->hsn_code}} <br>
                                                        <b>SKU:</b> {{$data->sku}}
                                                    @endif
                                                </td>
                                                <td class="text-left"><b>MC:</b>
                                                    @foreach ($data->category_id as $category)
                                                        {{App\Models\Admin\Category::where('id',$category)->first()->name}}/
                                                    @endforeach <br>
                                                    <b>S.C:</b>
                                                    @foreach ($data->subcategory_id as $subcategory)
                                                        {{optional(App\Models\Admin\SubCategory::where('id',$subcategory)->first())->name}}/
                                                    @endforeach <br>
                                                    @if($data->subsubcategory_id)
                                                        <b>S.S.C:</b>
                                                        @foreach ($data->subsubcategory_id as $subsubcategory)
                                                            {{App\Models\Admin\SubSubCategory::where('id',$subsubcategory)->first()->name}}/
                                                        @endforeach
                                                    @endif
                                                    <b>Brand:</b> {{$data->brand->name}}
                                                </td>
                                                @if(featureActivation('purchase_vendor') == '1')
                                                    <td class="text-left">
                                                        <b>Available:</b> {{App\Models\Admin\Product::where('product_group_id',$data->product_group_id)->get()->sum('current_stock')}}<br>
                                                        <b>Sold:</b> 0
                                                    </td>
                                                @endif
                                                {{-- <td class="text-left">
                                                    <b>RE:</b>{{getPriceRange($data->product_group_id)['retailer_min_price']}} @if(getPriceRange($data->product_group_id)['retailer_min_price'] != getPriceRange($data->product_group_id)['retailer_max_price']) - {{getPriceRange($data->product_group_id)['retailer_max_price']}} @endif<br>
                                                    <b>DI:</b>{{getPriceRange($data->product_group_id)['distributor_min_price']}} @if(getPriceRange($data->product_group_id)['distributor_min_price'] != getPriceRange($data->product_group_id)['distributor_max_price']) - {{getPriceRange($data->product_group_id)['distributor_max_price']}} @endif <br>
                                                    <b>DE:</b>{{getPriceRange($data->product_group_id)['wholeseller_min_price']}} @if(getPriceRange($data->product_group_id)['wholeseller_min_price'] != getPriceRange($data->product_group_id)['wholeseller_max_price']) - {{getPriceRange($data->product_group_id)['wholeseller_max_price']}} @endif
                                                </td>
                                                <td class="text-left">
                                                    <b>RE:</b>{{getPriceRange($data->product_group_id)['retailer_min_point']}} @if(getPriceRange($data->product_group_id)['retailer_min_point'] != getPriceRange($data->product_group_id)['retailer_max_point']) - {{getPriceRange($data->product_group_id)['retailer_max_point']}} @endif <br>
                                                    <b>DI:</b>{{getPriceRange($data->product_group_id)['distributor_min_point']}} @if(getPriceRange($data->product_group_id)['distributor_min_point'] != getPriceRange($data->product_group_id)['distributor_max_point']) - {{getPriceRange($data->product_group_id)['distributor_max_point']}} @endif <br>
                                                    <b>DE:</b>{{getPriceRange($data->product_group_id)['wholeseller_min_point']}} @if(getPriceRange($data->product_group_id)['wholeseller_min_point'] != getPriceRange($data->product_group_id)['wholeseller_max_point']) - {{getPriceRange($data->product_group_id)['wholeseller_max_point']}} @endif
                                                </td> --}}
                                                <td class="text-center">
                                                    <a href="{{route('admin.products.edit',$data->id)}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.products.destroy',$data->id)}}" onclick="return confirm('Are you sure you want to delete this Product?');" class="btn btn-outline-danger btn-sm mr-1 mb-1">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
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
                                    {!! $list->appends(['key'=>$search,'search_category_id'=>$search_category,'search_subcategory_id'=>$search_subcategory,'search_brand_id'=>$search_brand])->links() !!}
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
                get_sub_sub_categories()
            }
        });
    }

    function get_sub_sub_categories()
    {
        var sub_sub_cat="{{$search_subsubcategory}}";
        var subcategory_ids=$('#search_subcategory_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('admin.get.sub.sub.categories.by.subcategory')}}",
            data:{
                subcategory_ids:subcategory_ids
            },
            success: function(data) {
                $('#search_subsubcategory_id').empty();
                $.each(data, function(key, val) {
                    test= sub_sub_cat.includes(''+val.id);
                    $('#search_subsubcategory_id').append('<option value="'+ val.id +'" '+(test ? "selected" : "")+'  >'+ val.name +'</option>');
                });
            }
        });
    }

</script>
