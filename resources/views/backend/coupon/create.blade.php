@extends('backend.include.header')
@section('content')

<style>
    .modal-xl
    {
        max-width: 1345px;
    }
</style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.coupons.index')}}">Coupon List</a></li>
                            <li class="breadcrumb-item active">Add Coupon</li>
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
                                    <form class="form-example" id="form">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="type">Type</label>
                                                        <select name="type" class="form-control select2" id="type" onchange="get_product()">
                                                            <option value="">Select Type...</option>
                                                            <option value="total_order_amount">Total Order Amount</option>
                                                            <option value="product_base">Product Base</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="code">Code</label>
                                                        <input type="text" name="code" id="code" class="form-control" placeholder="Enter Code...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                            <div class="form-control file-amount">Choose Image</div>
                                                            <input type="hidden" name="image" class="selected-files">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                            </div>
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control summernote" name="description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="minimum_order_value">Minimum Order Value</label>
                                                        <input type="number" step="0.01" min="0.00" name="minimum_order_value" id="minimum_order_value" class="form-control" placeholder="Enter Minimum Order Value...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="maximum_discount_amount">Maximum Discount Amount</label>
                                                        <input type="number" step="0.01" min="0.00" name="maximum_discount_amount" id="maximum_discount_amount" class="form-control" placeholder="Enter Maximum Discount Amount...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="discount">Discount</label>
                                                        <input type="number" step="0.01" min="0.00" name="discount" id="discount" class="form-control" placeholder="Enter Discount...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="discount_type">Discount Type</label>
                                                        <select name="discount_type" class="form-control select2" id="discount_type">
                                                            <option value="">Select Discount Type...</option>
                                                            <option value="amount">Amount</option>
                                                            <option value="percent">Percent</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label for="number_of_usages">Number Of Usages</label>
                                                        <input type="number" min="1" name="number_of_usages" id="number_of_usages" class="form-control" placeholder="Enter Number Of Usages...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="form-group">
                                                        <label>Date range:</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-calendar-alt"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="date_range" class="form-control float-right" id="reservation" placeholder="Select Date Range...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div d-none" id="add_more_product_div" style="margin-top:30px">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary" onclick="get_product()">Add More Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="card-body table-responsive p-2" id="product_table_xyz">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="button" class="btn btn-outline-success mt-1 mb-1" onclick="save_offer_product()"><i class="fa fa-check" aria-hidden="true"></i> SAVE</button>
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

    <!-- Large modal -->
    <div id="con-close-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="display:inline;padding:5px">
                    <form id="search_form">
                    <div class="row">
                            <div class="col-md-2">
                                <select name="category_id[]" id="category_id" class="form-control select2" onchange="get_sub_category()" data-placeholder="Select Category..." multiple>
                                    <option value="">Select Category...</option>
                                    @foreach (App\Models\Admin\Category::orderBy('name','asc')->get() as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="sub_category_id[]" id="sub_category_id" class="form-control select2" onchange="get_sub_sub_category()"  data-placeholder="Select SubCategory..."  multiple></select>
                            </div>
                            <div class="col-md-2">
                                <select name="sub_sub_category_id[]" id="sub_sub_category_id" class="form-control select2" data-placeholder="Select SubSubCategory..."  multiple></select>
                            </div>
                            <div class="col-md-2">
                                <select name="brand_id" id="brand_id" class="form-control select2" onchange="filter_data()">
                                    <option value="">Select Brand...</option>
                                    @foreach (App\Models\Admin\Brnad::orderBy('name','asc')->get() as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="price_range" id="price_range" class="form-control select2" onchange="filter_data()">
                                    <option value="">Select Price Range...</option>
                                    <option value="1000 - 5000">1000 - 5000</option>
                                    <option value="5000 - 10000">5000 - 10000</option>
                                    <option value="10000 - 20000">10000 - 20000</option>
                                    <option value="20000 - 50000">20000 - 50000</option>
                                    <option value="50000 - 100000">50000 - 100000</option>
                                    <option value="More than 100000">More than 100000</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-sm" >
                                    <input type="text" name="key" value="" class="form-control float-right" placeholder="Search" onchange="filter_data()">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </form>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body p-2" id="modal_body"></div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" onclick="get_product_table()">Add</button>
                </div>
            </div>
        </div>
    </div>

@endsection

<script src="{{ asset('public/dashboard_css/plugins/jquery/jquery.min.js') }}"></script>

<script>

    $(localStorage.clear());

    function get_product()
    {
        var type = $('#type').val();
        if(type)
        {
            if(type == 'product_base')
            {
                $('#add_more_product_div').removeClass('d-none')
                $('#con-close-modal').modal('show');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url:"{{route('admin.get.products')}}",
                    success: function(data){
                        $('#modal_body').html(data);
                    }
                });
            }
            else{
                $('#add_more_product_div').addClass('d-none')
            }
        }
        else{
            $('#add_more_product_div').addClass('d-none')
            alert('Select Type!')
        }
    }

    function get_product_table()
    {
        var productss = localStorage.getItem('product');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('admin.get.coupon.product.table')}}",
            data:{
                products:productss
            },
            success: function(data) {
                $('#product_table_xyz').html(data);
                $('#con-close-modal').modal('hide');
            }
        });
    }

    function remove_local_data(name,id)
    {
        var cart = localStorage.getItem(name);
        var pcart = JSON.parse(cart) != null ? JSON.parse(cart) : [];
        var present_or_not = pcart.findIndex(item => item.property_id == id);

        var actual_stored_product = pcart[present_or_not];
        pcart.splice(present_or_not, 1);
        actual_stored_product.value =false ;
        pcart.push(actual_stored_product);
        localStorage.setItem(name, JSON.stringify(pcart));

        get_product_table()
    }

    function save_offer_product()
    {
        if(validate_form())
        {
            var vendor = $('#vendor').val()
            var ids = $("input[name='product_ids[]']").map(function(){return $(this).val();}).get();

            $.ajax({
                type: 'POST',
                url: "{{route('admin.coupons.store')}}",
                data: $('#form').serialize() + "&product_ids="+ids,
                success: function(data) {
                    localStorage.clear();
                    window.location.href = "{{route('admin.coupons.index')}}";
                }
            });
        }
        else
        {
            alert('Fill Required Fill!');
        }

    }

    $(document).on('click', '.product_index a', function(event)
    {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('admin.get.products')}}?&page=" + page,
            data: $('#search_form').serialize(),
            success: function(data) {
                $('#product_tables').html(data);
            }
        });
    }

    function filter_data()
    {
        var page = $('#current_page_number').val();
        fetch_data(page);
    }

    function save_local_data(name,id)
    {
        var checkbox = document.getElementById(name+'_'+id);
        var cart = localStorage.getItem(name);
        var pcart = JSON.parse(cart) != null ? JSON.parse(cart) : [];
        var present_or_not = pcart.findIndex(item => item.property_id == id);
        if (cart == null || present_or_not == null || present_or_not == -1)
        {
            var product = {
                property_id: id,
                value: checkbox.checked,
            };

            pcart.push(product);
            localStorage.setItem(name, JSON.stringify(pcart));
        }
        else
        {
            var actual_stored_product = pcart[present_or_not];
            pcart.splice(present_or_not, 1);
            actual_stored_product.value =checkbox.checked ;
            pcart.push(actual_stored_product);
            localStorage.setItem(name, JSON.stringify(pcart));
        }

    }

    function all_checked_data()
    {
        let cart = JSON.parse(localStorage.getItem("product"));
        if(cart)
        {
            var variant_id=[];
            $.each(cart, function(key, values)
            {
                $("#product_"+values.property_id).prop("checked",values.value);
                if (values.value == true)
                {
                    variant_id.push(values.property_id);
                }
            });
        }
        check_box_check();
    }


    function check_box_check()
    {
        var i=0;
        var j=0;
        $("input[type=checkbox]").each(function ()
        {
            if($(this).prop("checked"))
            {
                j++;
            }
            i++;
        });
        if(i-1==j)
        {
            $("#selectAll").prop("checked",'true');
        }
    }


</script>

<script>

    function get_sub_category()
    {
        var category_ids=$('#category_id').val();
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
                $('#sub_category_id').empty();
                $.each(data, function(key, val) {
                    $('#sub_category_id').append("<option value=" +val.id+ ">"+val.name+"</option>");
                });
                filter_data()
            }
        });
    }

    function get_sub_sub_category()
    {
        var subcategory_ids=$('#sub_category_id').val();
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
                $('#sub_sub_category_id').empty();
                $.each(data, function(key, val) {
                    $('#sub_sub_category_id').append("<option value=" +val.id+ ">"+val.name+"</option>");
                });
                filter_data()
            }
        });
    }

</script>

<script>

    function validate_form()
    {
        var vendor = $('#vendor').val()
        var ids = $("input[name='product_ids[]']").map(function(){return $(this).val();}).get();
        var stockes = $("input[name='stockes[]']").map(function(){return $(this).val();}).get();
        var values = $("input[name='purchase_prices[]']").map(function(){return $(this).val();}).get();

        if(vendor == "")
        {
            $('#vendor').addClass('is-invalid')
            return 0;
        }
        else
        {
            $('#vendor').removeClass('is-invalid')
            var re = 1;
            $.each(values, function(key, val) {
                if(val.length == 0)
                {
                    re = 0;
                }
            });
            if(re)
            {
                return 1;
            }
            else
            {
                return 0;
            }

            var res = 1;
            $.each(stockes, function(key, val) {
                if(val.length == 0)
                {
                    res = 0;
                }
            });
            if(res)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }

</script>
