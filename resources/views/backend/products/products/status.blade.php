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
                                    <form action="{{route('admin.products.status.index')}}">
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
                                                    <select name="search_brand_id[]" id="search_brand_id" class="form-control select2" data-placeholder="Select Brand" multiple>
                                                        @foreach (App\Models\Admin\Brnad::orderBy('name','asc')->get() as $brand)
                                                            <option value="{{$brand->id}}" @isset($search_brand) @if(in_array($brand->id,json_decode($search_brand))) selected @endif @endisset>{{$brand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="input-group input-group-sm" style="padding-top:-10px">
                                                    <input type="text" name="key" value="{{$search}}" class="form-control float-right" placeholder="Search">
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
                                            <th class="text-center">Name</th>
                                            @if(featureActivation('retailer') == '1' || featureActivation('destributor') == '1' || featureActivation('wholeseller') == '1')
                                            <th class="text-center">Price</th>
                                            @endif
                                            @if(featureActivation('purchase_vendor') == '1')
                                                <th class="text-center">Stock</th>
                                            @endif
                                            <th class="text-center">Is Active</th>
                                            <th class="text-center">Is Feature</th>
                                            <th class="text-center">Is Trending</th>
                                            <th class="text-center">Is BestSeller</th>
                                            <th class="text-center">Is New Arrival</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td class="text-left">
                                                    <img src="{{asset('public/'.api_asset($data->thumbnail_image))}}" style="height:80px;width: 80px;margin-right: 10px;">
                                                    @if($data->variant_name)
                                                        {{$data->variant_name}}
                                                    @else
                                                        {{$data->name}}
                                                    @endif
                                                </td>
                                                @if(featureActivation('retailer') == '1' || featureActivation('destributor') == '1' || featureActivation('wholeseller') == '1')
                                                    <td>
                                                        @if(featureActivation('retailer') == '1')
                                                            <b>Retailer:</b>{{$data->retailer_selling_price}}<br>
                                                        @endif
                                                        @if(featureActivation('distributor') == '1')
                                                            <b>Distributor:</b>{{$data->distributor_selling_price}}<br>
                                                        @endif
                                                        @if(featureActivation('wholeseller') == '1')
                                                            <b>Wholeseller:</b>{{$data->wholeseller_selling_price}}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if(featureActivation('purchase_vendor') == '1')
                                                    <td>
                                                        <b>Available:</b> {{$data->current_stock}} <br>
                                                        <b>Sold:</b> 0
                                                    </td>
                                                @endif
                                                <td class="text-center">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="is_active_{{$key}}" value="{{$data->id}}" onchange="is_active({{$key}})" @if($data->is_active) checked @endif>
                                                        <label class="custom-control-label" for="is_active_{{$key}}"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="is_feature_{{$key}}" value="{{$data->id}}" onchange="is_feature({{$key}})" @if($data->is_feature) checked @endif>
                                                        <label class="custom-control-label" for="is_feature_{{$key}}"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="is_trending_{{$key}}" value="{{$data->id}}" onchange="is_trending({{$key}})" @if($data->is_trending) checked @endif>
                                                        <label class="custom-control-label" for="is_trending_{{$key}}"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="is_bestseller_{{$key}}" value="{{$data->id}}" onchange="is_bestseller({{$key}})" @if($data->is_bestseller) checked @endif>
                                                        <label class="custom-control-label" for="is_bestseller_{{$key}}"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="is_newarrival_{{$key}}" value="{{$data->id}}" onchange="is_newarrival({{$key}})" @if($data->is_new_arrival) checked @endif>
                                                        <label class="custom-control-label" for="is_newarrival_{{$key}}"></label>
                                                    </div>
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

    function is_active(id)
    {
        var value=$('#is_active_'+id).prop("checked");
        var id=$('#is_active_'+id).val();

        if(value)
        {
            var value = 1;
        }
        else
        {
            var value = 0;
        }

        $.ajax({
            type: 'GET',
            url: "{{route('admin.products.status.update',['',''])}}/"+id+'/'+value+'?type=is_active',
            success: function(data) {
                if(value)
                {
                    toastr.success('Product Activeted Successfully!')
                }
                else
                {
                    toastr.error('Product Deactiveted Successfully!')
                }
            }
        });
    }

    function is_feature(id)
    {
        var value=$('#is_feature_'+id).prop("checked");
        var id=$('#is_feature_'+id).val();

        if(value)
        {
            var value = 1;
        }
        else
        {
            var value = 0;
        }

        $.ajax({
            type: 'GET',
            url: "{{route('admin.products.status.update',['',''])}}/"+id+'/'+value+'?type=is_feature',
            success: function(data) {
                if(value)
                {
                    toastr.success('Product Featured Successfully!')
                }
                else
                {
                    toastr.error('Product Not Featured Successfully!')
                }
            }
        });
    }

    function is_trending(id)
    {
        var value=$('#is_trending_'+id).prop("checked");
        var id=$('#is_trending_'+id).val();

        if(value)
        {
            var value = 1;
        }
        else
        {
            var value = 0;
        }

        $.ajax({
            type: 'GET',
            url: "{{route('admin.products.status.update',['',''])}}/"+id+'/'+value+'?type=is_trending',
            success: function(data) {
                if(value)
                {
                    toastr.success('Product Trending Successfully!')
                }
                else
                {
                    toastr.error('Product Not Trending Successfully!')
                }
            }
        });
    }

    function is_bestseller(id)
    {
        var value=$('#is_bestseller_'+id).prop("checked");
        var id=$('#is_bestseller_'+id).val();

        if(value)
        {
            var value = 1;
        }
        else
        {
            var value = 0;
        }

        $.ajax({
            type: 'GET',
            url: "{{route('admin.products.status.update',['',''])}}/"+id+'/'+value+'?type=is_bestseller',
            success: function(data) {
                if(value)
                {
                    toastr.success('Product BestSeller Successfully!')
                }
                else
                {
                    toastr.error('Product Not BestSeller Successfully!')
                }
            }
        });
    }

    function is_newarrival(id)
    {
        var value=$('#is_newarrival_'+id).prop("checked");
        var id=$('#is_newarrival_'+id).val();

        if(value)
        {
            var value = 1;
        }
        else
        {
            var value = 0;
        }

        $.ajax({
            type: 'GET',
            url: "{{route('admin.products.status.update',['',''])}}/"+id+'/'+value+'?type=is_new_arrival',
            success: function(data) {
                if(value)
                {
                    toastr.success('Product New Arrival Successfully!')
                }
                else
                {
                    toastr.error('Product Not New Arrival Successfully!')
                }
            }
        });
    }

</script>
