@extends('backend.include.header')
@section('content')

<style>
    .variant
    {
        background: #f7f7f7;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        margin: 0px 0 10px;
    }
   </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.products.index')}}">Product List</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
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
                                    <form action="{{route('admin.products.update',$product->id)}}" method="POST" class="form-example" id="choice_form">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" placeholder="Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="tags">Tags</label>
                                                        <input type="text" class="form-control aiz-tag-input" id="tags" name="tags[]" value="{{$product->tags}}" placeholder="Tags...">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form_div">
                                                    <div class="form-group">
                                                        <label for="category_id">Category</label>
                                                        <select name="category_id[]" id="category_id" class="form-control select2" data-placeholder="Select Category" multiple required onchange="get_sub_categories()">
                                                            @foreach (App\Models\Admin\Category::orderBy('priority','asc')->get() as $category)
                                                                <option value="{{$category->id}}" @if(in_array($category->id,$product->category_id)) selected @endif>{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form_div">
                                                    <div class="form-group">
                                                        <label for="sub_category_id">SubCategory</label>
                                                        <select name="subcategory_id[]" id="subcategory_id" class="form-control select2" data-placeholder="Select SubCategory" multiple required onchange="get_sub_sub_categories()"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form_div">
                                                    <div class="form-group">
                                                        <label for="subsubcategory_id">SubSubCategory</label>
                                                        <select name="subsubcategory_id[]" id="subsubcategory_id" class="form-control select2" data-placeholder="Select SubSubCategory" multiple></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form_div">
                                                    <div class="form-group">
                                                        <label for="brand_id">Brand</label>
                                                        <select name="brand_id" id="brand_id" class="form-control select2" data-placeholder="Select Brand" required>
                                                            <option value="">Select Brand</option>
                                                            @foreach (App\Models\Admin\Brnad::orderBy('name','asc')->get() as $brand)
                                                                <option value="{{$brand->id}}" @if($product->brand_id == $brand->id) selected @endif>{{$brand->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 form_div">
                                                    <div class="form-group">
                                                        <label for="unit">Unit</label>
                                                        <select name="unit" class="form-control select2">
                                                            <option value="">Select Unit...</option>
                                                            @foreach (App\Models\Admin\Unit::orderBy('name','asc')->get() as $unit)
                                                                <option value="{{$unit->name}}" @if($product->unit == $unit->name) selected @endif>{{$unit->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 form_div">
                                                    <div class="form-group">
                                                        <label for="hsn_code">HSN Code</label>
                                                        <input type="text" class="form-control" id="hsn_code" name="hsn_code" value="{{$product->hsn_code}}" placeholder="HSN Code...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="input-group">
                                                        <div class="form-group" style="width: 49%;">
                                                            <label for="tax_type">Tax Type</label>
                                                            <select name="tax_type" id="tax_type" class="form-control">
                                                                <option value="include" @if($product->tax_type == 'include') selected @endif>Include</option>
                                                                <option value="exclude" @if($product->tax_type == 'exclude') selected @endif>Exclude</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tax_amount">Tax Amount (%)</label>
                                                            <input type="number" step="0.01" class="form-control" id="tax_amount" name="tax_amount" value="{{$product->tax_amount}}" min="0.00" placeholder="Tax Amount (%)...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="input-group">
                                                        <div class="form-group" style="width: 49%;">
                                                            <label for="shipping_type">Shipping Type</label>
                                                            <select name="shipping_type" id="shipping_type" class="form-control">
                                                                <option value="free" @if($product->shipping_type == 'free') selected @endif>Free</option>
                                                                <option value="paid" @if($product->shipping_type == 'paid') selected @endif>Paid</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="shipping_amount">Shipping Amount</label>
                                                            <input type="number" step="0.01" class="form-control" id="shipping_amount" name="shipping_amount" value="{{$product->shipping_amount}}" min="0.00" placeholder="Shipping Amount...">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control summernote" name="description">{{$product->description}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="specification">Specification</label>
                                                        <textarea class="form-control summernote" name="specification">{{$product->specification}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $is_var = 0;
                                                $var_pros=app\Models\Admin\Product::where('product_group_id',$product->product_group_id)->get();
                                                if(count($var_pros))
                                                {
                                                    if($product->variant_name)
                                                    {
                                                        $is_var = 1;
                                                    }
                                                }
                                            @endphp

                                            <div class="single">
                                            <div class="field_wrapper">
                                                @if ($is_var)
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6 form_div"></div>
                                                        <div class="col-md-6 form_div d-flex justify-content-end" id="add_button">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary add_button" type="button">Add Variant</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        @foreach($var_pros as $pr_key=>$var_pro)
                                                            <input type="hidden" name="variant_id[]" value="{{$var_pro->id}}">
                                                            <div class="row">
                                                                <div class="col-md-5 form_div">
                                                                    <div class="form-group">
                                                                        <label for="colors">Colors</label>
                                                                        <select class="form-control select2 colors_{{$pr_key+1}}"  name="colors{{$pr_key+1}}" data-placeholder="Color" @if(!$var_pro->colors) disabled @endif>
                                                                            @foreach (\App\Models\Admin\Color::orderBy('name', 'asc')->get() as $key => $color)
                                                                                <option  value="{{$color->code}}" @if($var_pro->colors == $color->code) selected @endif>{{$color->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1 form_div">
                                                                    <div class="form-group d-flex justify-content-center" style="padding-top: 60%;">
                                                                        <label class="aiz-switch aiz-switch-success mb-0">
                                                                            <input value="1" type="checkbox" name="colors_active[]" onchange="color_change({{$pr_key+1}})" class="color_button_{{$pr_key+1}}" @if($var_pro->colors) checked @endif>
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form_div">
                                                                    <div class="form-group">
                                                                        <label for="specification">Attribute</label>
                                                                        <select class="form-control select2" name="choice_attributes_{{$pr_key+1}}[]" id="attribute_{{$pr_key+1}}" data-placeholder="Attribute" multiple onchange="get_attribute_value({{$pr_key+1}})"></select>
                                                                    </div>
                                                                </div>
                                                                <div class="brck " id="attr_val_div_{{$pr_key+1}}" style="display: contents; width: 100%;"></div>
                                                                <div class="clearfix" style="width:100%"></div>
                                                                <script>
                                                                    var category_ids=$('#category_id').val();
                                                                    $.ajax({
                                                                        type: 'GET',
                                                                        url: "{{route('admin.get.attributes.by.category','')}}/"+category_ids,
                                                                        success: function(data) {
                                                                            @if($var_pro->attribute != "")
                                                                                var attr=[<?php echo '"'.implode('","', $var_pro->attribute).'"' ?>];
                                                                            @else
                                                                                var attr=[];
                                                                            @endif
                                                                            $('#attribute_'+{{$pr_key+1}}).empty();
                                                                            $.each(data, function(key, val) {
                                                                                tests= attr.includes(''+val.id);
                                                                                $('#attribute_'+{{$pr_key+1}}).append("<option value=" +val.id+ " "+(tests ? 'selected' : "")+">"+val.name+"</option>");
                                                                            });
                                                                            var attr_val=$('#attribute_'+{{$pr_key+1}}).val();
                                                                            $.ajax({
                                                                                type: 'GET',
                                                                                url: "{{route('admin.get.attribute.value','')}}/"+attr_val,
                                                                                success: function(data) {
                                                                                    @if($var_pro->attribute_value)
                                                                                        var attr_vale=[<?php echo '"'.implode('","', $var_pro->attribute_value).'"' ?>];
                                                                                    @else
                                                                                        var attr_vale=[];
                                                                                    @endif
                                                                                    $('#attr_val_div_'+{{$pr_key+1}}).contents().remove();
                                                                                    $.each(data, function(key, val) {
                                                                                        var values='';
                                                                                        $.each(val.value, function(k, v) {
                                                                                            tests1= attr_vale.includes(''+v);
                                                                                            values+='<option '+(tests1 ? "selected" : '')+'>'+v+'</option>';
                                                                                        });
                                                                                        $('#attr_val_div_'+{{$pr_key+1}}).append('<div class="col-md-4 form_div">'+
                                                                                                                        '<div class="input-group mb-3">'+
                                                                                                                            '<div class="input-group-prepend">'+
                                                                                                                                '<label class="input-group-text" for="inputGroupSelect01">'+val.name+'</label>'+
                                                                                                                            '</div>'+
                                                                                                                            '<select class="custom-select select2" name="choice_option_'+{{$pr_key+1}}+'[]">'+
                                                                                                                                '<option selected>Choose...</option>'+
                                                                                                                                values+
                                                                                                                            '</select>'+
                                                                                                                        '</div>'+
                                                                                                                    '</div>');
                                                                                    });
                                                                                }
                                                                            });
                                                                        }
                                                                    });
                                                                </script>
                                                                <div class="col-md-4 form_div">
                                                                    <div class="form-group">
                                                                        <label for="variant_name">Variant Name</label>
                                                                        <input type="text" class="form-control" name="variant_name[]" value="{{$var_pro->variant_name}}"placeholder="Variant Name..." required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 form_div">
                                                                    <div class="form-group">
                                                                        <label>Thumbnail Image</label>
                                                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                                            <div class="form-control file-amount">Choose Icon</div>
                                                                            <input type="hidden" name="thumbnail_image[]" class="selected-files" value="{{$var_pro->thumbnail_image}}">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="file-preview box sm"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 form_div">
                                                                    <div class="form-group">
                                                                        <label>Gallery Image</label>
                                                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                                            <div class="form-control file-amount">Choose Icon</div>
                                                                            <input type="hidden" name="gallery_image[]" class="selected-files" value="{{$var_pro->gallery_image}}">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="file-preview box sm"></div>
                                                                    </div>
                                                                </div>
                                                                {{--<div class="col-md-2 form_div">
                                                                    <div class="form-group">
                                                                        <label for="purchase_price">Purchase Price</label>
                                                                        <input type="text" class="form-control" name="purchase_price[]" value="{{$var_pro->purchase_price}}" placeholder="Purchase Price..." required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 form_div">
                                                                    <div class="form-group">
                                                                        <label for="mrp_price">Mrp Price</label>
                                                                        <input type="text" class="form-control" name="mrp_price[]" value="{{$var_pro->mrp_price}}" placeholder="Mrp Price..." required>
                                                                    </div>
                                                                </div>--}}
                                                                <div class="col-md-4 form_div">
                                                                    <div class="form-group">
                                                                        <label for="barcode_id">Barcode Id</label>
                                                                        <input type="text" class="form-control" name="barcode_id[]" value="{{$var_pro->barcode_id}}" placeholder="Barcode Id...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 form_div">
                                                                    <div class="form-group">
                                                                        <label for="sku">SKU</label>
                                                                        <input type="text" class="form-control" name="sku[]" value="{{$var_pro->sku}}" placeholder="SKU...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 form_div">
                                                                    <div class="form-group">
                                                                        <label for="video_link">Video Link</label>
                                                                        <input type="text" class="form-control" name="video_link[]" value="{{$var_pro->video_link}}" placeholder="Video Link...">
                                                                    </div>
                                                                </div>
                                                                @if(featureActivation('retailer') == '1')
                                                                <div class="col-md-2 form_div">
                                                                    <div class="form-group">
                                                                        <label for="retailer_selling_price">Retailer Selling Price</label>
                                                                        <input type="text" class="form-control" name="retailer_selling_price[]" value="{{$var_pro->retailer_selling_price}}" placeholder="Selling Price...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 form_div">
                                                                    <div class="input-group">
                                                                        <div class="form-group" style="width:192px;">
                                                                            <label for="retailer_discount_type">Discount Type</label>
                                                                            <select name="retailer_discount_type[]" class="form-control">
                                                                                <option value="amount" @if($var_pro->retailer_discount_type == 'amount') selected @endif>Flat</option>
                                                                                <option value="percent" @if($var_pro->retailer_discount_type == 'percent') selected @endif>Percent</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="retailer_discount">Discount</label>
                                                                            <input type="text" class="form-control" name="retailer_discount[]" value="{{$var_pro->retailer_discount}}" min="0.00" placeholder="Discount...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 form_div">
                                                                    <div class="form-group">
                                                                        <label for="retailer_min_qty">Min Qty</label>
                                                                        <input type="text" class="form-control" name="retailer_min_qty[]" value="{{$var_pro->retailer_min_qty}}" min="1" placeholder="Min Qty..." required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 form_div">
                                                                    <div class="form-group">
                                                                        <label for="retailer_max_qty">Max Qty</label>
                                                                        <input type="text" class="form-control" name="retailer_max_qty[]" value="{{$var_pro->retailer_max_qty}}" placeholder="Max Qty...">
                                                                    </div>
                                                                </div>
                                                                @if(featureActivation('mlm') == '1')
                                                                <div class="col-md-2 form_div">
                                                                    <div class="form-group">
                                                                        <label for="retailer_point">Point</label>
                                                                        <input type="text" class="form-control" name="retailer_point[]" value="{{$var_pro->retailer_point}}" min="0" placeholder="Point...">
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @if(featureActivation('distributor') == '1')
                                                                <div class="col-md-4 form_div">
                                                                    <div class="form-group">
                                                                        <label for="distributor_selling_price">Distributor Selling Price</label>
                                                                        <input type="text" class="form-control" name="distributor_selling_price[]" value="{{$var_pro->distributor_selling_price}}" placeholder="Selling Price...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 form_div">
                                                                    <div class="input-group">
                                                                        <div class="form-group">
                                                                            <label for="distributor_discount_type">Discount Type</label>
                                                                            <select name="distributor_discount_type[]" class="form-control" style="width: 192px;">
                                                                                <option value="amount" @if($var_pro->distributor_discount_type == 'amount') selected @endif>Flat</option>
                                                                                <option value="percent" @if($var_pro->distributor_discount_type == 'percent') selected @endif>Percent</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="distributor_discount">Discount</label>
                                                                            <input type="text" class="form-control" name="distributor_discount[]" value="{{$var_pro->distributor_discount}}" min="0.00" placeholder="Discount...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 form_div">
                                                                    <div class="form-group">
                                                                        <label for="distributor_min_qty">Min Qty</label>
                                                                        <input type="text" class="form-control" name="distributor_min_qty[]" value="{{$var_pro->distributor_min_qty}}" min="1" placeholder="Min Qty..." required>
                                                                    </div>
                                                                </div>
                                                                @if(featureActivation('mlm') == '1')
                                                                <div class="col-md-2 form_div">
                                                                    <div class="form-group">
                                                                        <label for="distributor_point">Point</label>
                                                                        <input type="text" class="form-control" name="distributor_point[]" value="{{$var_pro->distributor_point}}" min="0" placeholder="Point...">
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @if(featureActivation('wholeseller') == '1')
                                                                <div class="col-md-4 form_div">
                                                                    <div class="form-group">
                                                                        <label for="wholeseller_selling_price">Wholeseller Selling Price</label>
                                                                        <input type="text" class="form-control" name="wholeseller_selling_price[]" value="{{$var_pro->wholeseller_selling_price}}" placeholder="Selling Price...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 form_div">
                                                                    <div class="input-group">
                                                                        <div class="form-group">
                                                                            <label for="wholeseller_discount_type">Discount Type</label>
                                                                            <select name="wholeseller_discount_type[]" class="form-control" style="width: 192px;">
                                                                                <option value="amount" @if($var_pro->wholeseller_discount_type == 'amount') selected @endif>Flat</option>
                                                                                <option value="percent" @if($var_pro->wholeseller_discount_type == 'percent') selected @endif>Percent</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="wholeseller_discount">Discount</label>
                                                                            <input type="text" class="form-control" name="wholeseller_discount[]" value="{{$var_pro->wholeseller_discount}}" min="0.00" placeholder="Discount...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 form_div">
                                                                    <div class="form-group">
                                                                        <label for="wholeseller_min_qty">Min Qty</label>
                                                                        <input type="text" class="form-control" name="wholeseller_min_qty[]" value="{{$var_pro->wholeseller_min_qty}}" min="1" placeholder="Min Qty..." required>
                                                                    </div>
                                                                </div>
                                                                @if(featureActivation('mlm') == '1')
                                                                <div class="col-md-2 form_div">
                                                                    <div class="form-group">
                                                                        <label for="wholeseller_point">Point</label>
                                                                        <input type="text" class="form-control" name="wholeseller_point[]" value="{{$var_pro->wholeseller_point}}" min="0" placeholder="Point...">
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                <div class="col-md-12 form_div d-flex justify-content-center">
                                                                    <div class="form-group">
                                                                        <button class="btn btn-danger remove_button" type="button">Remove Variant</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr id="hr_{{$pr_key+1}}">
                                                        @endforeach
                                                @else
                                                    <input type="hidden" name="variant_id[]" value="{{$product->id}}">
                                                        <div class="row" id="single_product_price_div">
                                                            <div class="col-md-4 form_div">
                                                                <div class="form-group">
                                                                    <label>Thumbnail Image</label>
                                                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                                        <div class="form-control file-amount">Choose Icon</div>
                                                                        <input type="hidden" name="thumbnail_image[]" class="selected-files" value="{{$product->thumbnail_image}}">
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
                                                                    <label>Gallery Image</label>
                                                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                                        <div class="form-control file-amount">Choose Icon</div>
                                                                        <input type="hidden" name="gallery_image[]" class="selected-files" value="{{$product->gallery_image}}">
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
                                                                    <label for="video_link">Video Link</label>
                                                                    <input type="text" class="form-control" name="video_link[]" value="{{$product->video_link}}" placeholder="Video Link...">
                                                                </div>
                                                            </div>
                                                            {{--<div class="col-md-3 form_div">
                                                                <div class="form-group">
                                                                    <label for="purchase_price">Purchase Price</label>
                                                                    <input type="text" class="form-control" name="purchase_price[]" value="{{$product->purchase_price}}" placeholder="Purchase Price..." required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 form_div">
                                                                <div class="form-group">
                                                                    <label for="mrp_price">Mrp Price</label>
                                                                    <input type="text" class="form-control" name="mrp_price[]" value="{{$product->mrp_price}}" placeholder="Mrp Price..." required>
                                                                </div>
                                                            </div>--}}

                                                            <div class="col-md-6 form_div">
                                                                <div class="form-group">
                                                                    <label for="barcode_id">Barcode Id</label>
                                                                    <input type="text" class="form-control" name="barcode_id[]" value="{{$product->barcode_id}}" placeholder="Barcode Id...">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 form_div">
                                                                <div class="form-group">
                                                                    <label for="sku">SKU</label>
                                                                    <input type="text" class="form-control" name="sku[]" value="{{$product->sku}}" placeholder="SKU...">
                                                                </div>
                                                            </div>
                                                            @if(featureActivation('retailer') == '1')
                                                            <div class="col-md-2 form_div">
                                                                <div class="form-group">
                                                                    <label for="retailer_selling_price">Retailer Selling Price</label>
                                                                    <input type="text" class="form-control" name="retailer_selling_price[]" value="{{$product->retailer_selling_price}}" placeholder="Selling Price...">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 form_div">
                                                                <div class="input-group">
                                                                    <div class="form-group">
                                                                        <label for="retailer_discount_type">Discount Type</label>
                                                                        <select name="retailer_discount_type[]" class="form-control" style="width: 192px;">
                                                                            <option value="amount" @if($product->retailer_discount_type == 'amount') selected @endif>Flat</option>
                                                                            <option value="percent" @if($product->retailer_discount_type == 'percent') selected @endif>Percent</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="retailer_discount">Discount</label>
                                                                        <input type="text" class="form-control" name="retailer_discount[]" value="{{$product->retailer_discount}}" min="0.00" placeholder="Discount...">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 form_div">
                                                                <div class="form-group">
                                                                    <label for="retailer_min_qty">Min Qty</label>
                                                                    <input type="text" class="form-control" name="retailer_min_qty[]" value="{{$product->retailer_min_qty}}" min="1" placeholder="Selling Price..." required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 form_div">
                                                                <div class="form-group">
                                                                    <label for="retailer_max_qty">Max Qty</label>
                                                                    <input type="text" class="form-control" name="retailer_max_qty[]" value="{{$product->retailer_max_qty}}" placeholder="Max Qty...">
                                                                </div>
                                                            </div>
                                                            @if(featureActivation('mlm') == '1')
                                                            <div class="col-md-2 form_div">
                                                                <div class="form-group">
                                                                    <label for="retailer_point">Point</label>
                                                                    <input type="text" class="form-control" name="retailer_point[]" value="{{$product->retailer_point}}" min="0" placeholder="Point...">
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endif
                                                            @if(featureActivation('distributor') == '1')
                                                            <div class="col-md-4 form_div">
                                                                <div class="form-group">
                                                                    <label for="distributor_selling_price">Distributor Selling Price</label>
                                                                    <input type="text" class="form-control" name="distributor_selling_price[]" value="{{$product->distributor_selling_price}}" placeholder="Selling Price...">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 form_div">
                                                                <div class="input-group">
                                                                <div class="form-group">
                                                                    <label for="distributor_discount_type">Discount Type</label>
                                                                    <select name="distributor_discount_type[]" class="form-control" style="width: 192px;">
                                                                        <option value="amount" @if($product->distributor_discount_type == 'amount') selected @endif>Flat</option>
                                                                        <option value="percent" @if($product->distributor_discount_type == 'percent') selected @endif>Percent</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="distributor_discount">Discount</label>
                                                                    <input type="text" class="form-control" name="distributor_discount[]" value="{{$product->distributor_discount}}" min="0.00" placeholder="Discount...">
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 form_div">
                                                                <div class="form-group">
                                                                    <label for="distributor_min_qty">Min Qty</label>
                                                                    <input type="text" class="form-control" name="distributor_min_qty[]" value="{{$product->distributor_min_qty}}" min="1" placeholder="Min Qty..." required>
                                                                </div>
                                                            </div>
                                                            @if(featureActivation('mlm') == '1')
                                                            <div class="col-md-2 form_div">
                                                                <div class="form-group">
                                                                    <label for="distributor_point">Point</label>
                                                                    <input type="text" class="form-control" name="distributor_point[]" value="{{$product->distributor_point}}" min="0" placeholder="Point...">
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endif
                                                            @if(featureActivation('wholeseller') == '1')
                                                            <div class="col-md-4 form_div">
                                                                <div class="form-group">
                                                                    <label for="wholeseller_selling_price">Wholeseller Selling Price</label>
                                                                    <input type="text" class="form-control" name="wholeseller_selling_price[]" value="{{$product->wholeseller_selling_price}}"  placeholder="Selling Price...">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 form_div">
                                                                <div class="input-group">
                                                                <div class="form-group">
                                                                    <label for="wholeseller_discount_type">Discount Type</label>
                                                                    <select name="wholeseller_discount_type[]" class="form-control" style="width: 192px;">
                                                                        <option value="amount" @if ($product->wholeseller_discount_type == 'amount') selected @endif>Flat</option>
                                                                        <option value="percent" @if ($product->wholeseller_discount_type == 'percent') selected @endif>Percent</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="wholeseller_discount">Discount</label>
                                                                    <input type="text" class="form-control" name="wholeseller_discount[]" value="{{$product->wholeseller_discount}}" min="0.00" placeholder="Discount...">
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="col-md-2 form_div">
                                                                <div class="form-group">
                                                                    <label for="wholeseller_min_qty">Min Qty</label>
                                                                    <input type="text" class="form-control" name="wholeseller_min_qty[]" value="{{$product->wholeseller_min_qty}}" min="1" placeholder="Min Qty..." required>
                                                                </div>
                                                            </div>
                                                            @if(featureActivation('mlm') == '1')
                                                            <div class="col-md-2 form_div">
                                                                <div class="form-group">
                                                                    <label for="wholeseller_point">Point</label>
                                                                    <input type="text" class="form-control" name="wholeseller_point[]" value="{{$product->wholeseller_point}}" min="0" placeholder="Point...">
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6 form_div"></div>
                                                        <div class="col-md-6 form_div d-flex justify-content-end" id="add_button">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary add_button" type="button">Add Variant</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Update this Product?');"><i class="fa fa-check" aria-hidden="true"></i> SAVE</button>
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

<script src="{{ asset('public/dashboard_css/plugins/jquery/jquery.min.js') }}"></script>



<script type="text/javascript">

    $(document).ready(function()
    {
        var x = parseInt({{count($var_pros)}}+1); //Initial field counter is 1
        var maxField = 50; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper

        //Once add button is clicked
        $(addButton).click(function()
        {
            $('.field_wrapper').addClass('variant')
            var category_ids=$('#category_id').val();
            var name=$('#name').val();
            if(category_ids.length  == 0)
            {
                alert('Select Category');
                return false;
            }
            if(x <= 1)
            {
                $('#single_product_price_div').remove();
            }
            var fieldHTML ='<div class="row">'+
                                '<div class="col-md-5 form_div">'+
                                    '<div class="form-group">'+
                                        '<label for="colors">Colors</label>'+
                                        '<select class="form-control select2 colors_'+x+'"  name="colors'+x+'" data-placeholder="Color" disabled>'+
                                            '@foreach (\App\Models\Admin\Color::orderBy('name', 'asc')->get() as $key => $color)'+
                                                '<option  value="{{ $color->code }}">{{$color->name}}</option>'+
                                            '@endforeach'+
                                        '</select>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-1 form_div">'+
                                    '<div class="form-group d-flex justify-content-center" style="padding-top: 60%;">'+
                                        '<label class="aiz-switch aiz-switch-success mb-0">'+
                                            '<input value="1" type="checkbox" name="colors_active[]" onchange="color_change('+x+')" class="color_button_'+x+'">'+
                                            '<span></span>'+
                                        '</label>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-6 form_div">'+
                                    '<div class="form-group">'+
                                        '<label for="specification">Attribute</label>'+
                                        '<select class="form-control select2" name="choice_attributes_'+x+'[]" id="attribute_'+x+'" data-placeholder="Attribute" multiple onchange="get_attribute_value('+x+')"></select>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="brck " id="attr_val_div_'+x+'" style="display: contents; width: 100%;">'+
                                '</div>'+

                                '<div class="clearfix" style="width:100%"></div>'+

                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="variant_name">Variant Name</label>'+
                                    '<input type="text" class="form-control" name="variant_name[]" value="'+name+'"placeholder="Variant Name..." required>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label>Thumbnail Image</label>'+
                                    '<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">'+
                                        '<div class="form-control file-amount">Choose Icon</div>'+
                                        '<input type="hidden" name="thumbnail_image[]" class="selected-files" value="">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="file-preview box sm">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label>Gallery Image</label>'+
                                    '<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">'+
                                        '<div class="form-control file-amount">Choose Icon</div>'+
                                        '<input type="hidden" name="gallery_image[]" class="selected-files" value="">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="file-preview box sm">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            // '<div class="col-md-2 form_div">'+
                            //     '<div class="form-group">'+
                            //        '<label for="purchase_price">Purchase Price</label>'+
                            //         '<input type="text" class="form-control" name="purchase_price[]" placeholder="Purchase Price..." required>'+
                            //     '</div>'+
                            // '</div>'+
                            // '<div class="col-md-2 form_div">'+
                            //     '<div class="form-group">'+
                            //         '<label for="mrp_price">Mrp Price</label>'+
                            //         '<input type="text" class="form-control" name="mrp_price[]" placeholder="Mrp Price..." required>'+
                            //     '</div>'+
                            // '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="barcode_id">Barcode Id</label>'+
                                    '<input type="text" class="form-control" name="barcode_id[]" placeholder="Barcode Id...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="sku">SKU</label>'+
                                    '<input type="text" class="form-control" name="sku[]" placeholder="SKU...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="video_link">Video Link</label>'+
                                    '<input type="text" class="form-control" name="video_link[]" placeholder="Video Link...">'+
                                '</div>'+
                            '</div>'+
                            @if(featureActivation('retailer') == '1')
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="retailer_selling_price">Retailer Selling Price</label>'+
                                    '<input type="text" class="form-control" name="retailer_selling_price[]" placeholder="Selling Price...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="input-group">'+
                                    '<div class="form-group">'+
                                        '<label for="retailer_discount_type">Discount Type</label>'+
                                        '<select name="retailer_discount_type[]" class="form-control" style="width:192px;">'+
                                            '<option value="amount">Flat</option>'+
                                            '<option value="percent">Percent</option>'+
                                        '</select>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="retailer_discount">Discount</label>'+
                                        '<input type="text" class="form-control" name="retailer_discount[]" value="0.00" min="0.00" placeholder="Discount...">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="retailer_min_qty">Min Qty</label>'+
                                    '<input type="text" class="form-control" name="retailer_min_qty[]" value="1" min="1" placeholder="Min Qty..." required>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="retailer_max_qty">Max Qty</label>'+
                                    '<input type="text" class="form-control" name="retailer_max_qty[]" placeholder="Max Qty...">'+
                                '</div>'+
                            '</div>'+
                            @if(featureActivation('mlm') == '1')
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="retailer_point">Point</label>'+
                                    '<input type="text" class="form-control" name="retailer_point[]" value="0" min="0" placeholder="Point...">'+
                                '</div>'+
                           '</div>'+
                           @endif
                           @endif
                           @if(featureActivation('distributor') == '1')
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="distributor_selling_price">Distributor Selling Price</label>'+
                                    '<input type="text" class="form-control" name="distributor_selling_price[]" placeholder="Selling Price...">'+
                                '</div>'+
                           '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="input-group">'+
                                '<div class="form-group">'+
                                    '<label for="distributor_discount_type">Discount Type</label>'+
                                    '<select name="distributor_discount_type[]" class="form-control" style="width: 192px;">'+
                                        '<option value="amount">Flat</option>'+
                                        '<option value="percent">Percent</option>'+
                                    '</select>'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label for="distributor_discount">Discount</label>'+
                                    '<input type="text" class="form-control" name="distributor_discount[]" value="0.00" min="0.00" placeholder="Discount...">'+
                                '</div>'+
                                '</div>'+
                           '</div>'+
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="distributor_min_qty">Min Qty</label>'+
                                    '<input type="text" class="form-control" name="distributor_min_qty[]" value="1" min="1" placeholder="Min Qty..." required>'+
                                '</div>'+
                            '</div>'+
                            @if(featureActivation('mlm') == '1')
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="distributor_point">Point</label>'+
                                    '<input type="text" class="form-control" name="distributor_point[]" value="0" min="0" placeholder="Point...">'+
                                '</div>'+
                            '</div>'+
                            @endif
                            @endif
                            @if(featureActivation('wholeseller') == '1')
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="wholeseller_selling_price">Wholeseller Selling Price</label>'+
                                    '<input type="text" class="form-control" name="wholeseller_selling_price[]" placeholder="Selling Price...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="input-group">'+
                                    '<div class="form-group">'+
                                        '<label for="wholeseller_discount_type">Discount Type</label>'+
                                        '<select name="wholeseller_discount_type[]" class="form-control" style="width: 192px;">'+
                                            '<option value="amount">Flat</option>'+
                                            '<option value="percent">Percent</option>'+
                                        '</select>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="wholeseller_discount">Discount</label>'+
                                        '<input type="text" class="form-control" name="wholeseller_discount[]" value="0.00" min="0.00" placeholder="Discount...">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="wholeseller_min_qty">Min Qty</label>'+
                                    '<input type="text" class="form-control" name="wholeseller_min_qty[]" value="1" min="1" placeholder="Min Qty..." required>'+
                                '</div>'+
                            '</div>'+
                            @if(featureActivation('mlm') == '1')
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="wholeseller_point">Point</label>'+
                                    '<input type="text" class="form-control" name="wholeseller_point[]" value="0" min="0" placeholder="Point...">'+
                                '</div>'+
                            '</div>'+
                            @endif
                            @endif
                            '<div class="col-md-12 form_div d-flex justify-content-center">'+
                                '<div class="form-group">'+
                                    '<button class="btn btn-danger remove_button" type="button">Remove Variant</button>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<hr id="hr_'+x+'">'//New input field html

            //Check maximum number of input fields
            if(x < maxField)
            {
                $(wrapper).append(fieldHTML); //Add field html
                get_attribute(x)
                $('.select2').select2();
                x++; //Increment field counter
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e)
        {
            e.preventDefault();
            $(this).closest('.row').remove(); //Remove field html
            x--; //Decrement field counter
            $('#hr_'+x).remove();
            if(x <= 1)
            {
                $('.single').append('<div class="row" id="single_product_price_div">'+
                                                '<div class="col-md-4 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label>Thumbnail Image</label>'+
                                                        '<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">'+
                                                            '<div class="form-control file-amount">Choose Icon</div>'+
                                                            '<input type="hidden" name="thumbnail_image[]" class="selected-files" value="">'+
                                                            '<div class="input-group-prepend">'+
                                                                '<div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<div class="file-preview box sm">'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-4 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label>Gallery Image</label>'+
                                                        '<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">'+
                                                            '<div class="form-control file-amount">Choose Icon</div>'+
                                                            '<input type="hidden" name="gallery_image[]" class="selected-files" value="">'+
                                                            '<div class="input-group-prepend">'+
                                                                '<div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<div class="file-preview box sm">'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-4 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="video_link">Video Link</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="video_link[]" placeholder="Video Link...">'+
                                                   '</div>'+
                                                '</div>'+
                                            //     '<div class="col-md-3 form_div">'+
                                            //         '<div class="form-group">'+
                                            //             '<label for="purchase_price">Purchase Price</label>'+
                                            //             '<input type="text" class="form-control" name="purchase_price[]" placeholder="Purchase Price..." required>'+
                                            //         '</div>'+
                                            //     '</div>'+
                                            //    '<div class="col-md-3 form_div">'+
                                            //         '<div class="form-group">'+
                                            //             '<label for="mrp_price">Mrp Price</label>'+
                                            //             '<input type="text" class="form-control" name="mrp_price[]" placeholder="Mrp Price..." required>'+
                                            //         '</div>'+
                                            //     '</div>'+
                                                '<div class="col-md-6 form_div">'+
                                                   '<div class="form-group">'+
                                                        '<label for="barcode_id">Barcode Id</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="barcode_id[]" placeholder="Barcode Id...">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-6 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="sku">SKU</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="sku[]" placeholder="SKU...">'+
                                                   '</div>'+
                                                '</div>'+
                                                @if(featureActivation('retailer') == '1')
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="retailer_selling_price">Retailer Selling Price</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="retailer_selling_price[]" placeholder="Selling Price...">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="retailer_discount_type">Retailer Discount Type</label>'+
                                                        '<select name="retailer_discount_type[]" class="form-control">'+
                                                            '<option value="amount">Flat</option>'+
                                                            '<option value="percent">Percent</option>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="retailer_discount">Retailer Discount</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="retailer_discount[]" value="0.00" min="0.00" placeholder="Discount...">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="video_link">Retailer Min Qty</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="retailer_min_qty[]" value="1" min="1" placeholder="Min Qty..." required>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="retailer_max_qty">Retailer Max Qty</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="retailer_max_qty[]" placeholder="Max Qty...">'+
                                                    '</div>'+
                                                '</div>'+
                                                @if(featureActivation('mlm') == '1')
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="retailer_discount">Retailer Point</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="retailer_point[]" value="0" min="0" placeholder="Point...">'+
                                                    '</div>'+
                                                '</div>'+
                                                @endif
                                                @endif
                                                @if(featureActivation('distributor') == '1')
                                                '<div class="col-md-3 form_div">'+
                                                   '<div class="form-group">'+
                                                        '<label for="distributor_selling_price">Distributor Selling Price</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="distributor_selling_price[]" placeholder="Selling Price...">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-3 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="distributor_discount_type">Distributor Discount Type</label>'+
                                                        '<select name="distributor_discount_type[]" class="form-control">'+
                                                            '<option value="amount">Flat</option>'+
                                                            '<option value="percent">Percent</option>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="distributor_discount">Distributor Discount</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="distributor_discount[]" value="0.00" min="0.00" placeholder="Discount...">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="distributor_min_qty">Distributor Min Qty</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="distributor_min_qty[]" value="1" min="1" placeholder="Min Qty..." required>'+
                                                    '</div>'+
                                                '</div>'+
                                                @if(featureActivation('mlm') == '1')
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="distributor_point">Distributor Point</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="distributor_point[]" value="0" min="0" placeholder="Point...">'+
                                                    '</div>'+
                                                '</div>'+
                                                @endif
                                                @endif
                                                @if(featureActivation('wholeseller') == '1')
                                                '<div class="col-md-3 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="wholeseller_selling_price">Wholeseller Selling Price</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="wholeseller_selling_price[]" placeholder="Selling Price...">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-3 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="wholeseller_discount_type">Wholeseller Discount Type</label>'+
                                                        '<select name="wholeseller_discount_type[]" class="form-control">'+
                                                            '<option value="amount">Flat</option>'+
                                                            '<option value="percent">Percent</option>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="wholeseller_discount">Wholeseller Discount</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="wholeseller_discount[]" value="0.00" min="0.00" placeholder="Discount...">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="wholeseller_min_qty">Wholeseller Min Qty</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="wholeseller_min_qty[]" value="1" min="1" placeholder="Min Qty..." required>'+
                                                   '</div>'+
                                                '</div>'+
                                                @if(featureActivation('mlm') == '1')
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="wholeseller_point">Wholeseller Point</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="wholeseller_point[]" value="0" min="0" placeholder="Point...">'+
                                                    '</div>'+
                                                '</div>'+
                                                @endif
                                                @endif
                                            '</div>')
            }
        });
    });
</script>

<script>

    $(setTimeout(
    function()
    {
        get_sub_categories()
    }, 1000))
    function get_sub_categories()
    {
        var category_ids=$('#category_id').val();
        var sub_cat=[<?php echo '"'.implode('","', $product->subcategory_id).'"' ?>];
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
                $('#subcategory_id').empty();
                $.each(data, function(key, val) {
                    test= sub_cat.includes(''+val.id);
                    $('#subcategory_id').append("<option value=" +val.id+ " "+(test ? 'selected' : "")+">"+val.name+"</option>");
                });
                get_sub_sub_categories();
            }
        });
    }

    function get_sub_sub_categories()
    {
        var subcategory_ids=$('#subcategory_id').val();
        @if($product->subsubcategory_id)
            var subsub_cat=[<?php echo '"'.implode('","', $product->subsubcategory_id).'"' ?>];
        @else
            var subsub_cat=[];
        @endif
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
                $('#subsubcategory_id').empty();
                $.each(data, function(key, val) {
                    test= subsub_cat.includes(''+val.id);
                    $('#subsubcategory_id').append("<option value=" +val.id+ " "+(test ? 'selected' : "")+">"+val.name+"</option>");
                });
            }
        });
    }

    function color_change(x)
    {
        if(!$('.color_button_'+x).is(':checked'))
        {
            $('.colors_'+x).prop('disabled', true);
        }
        else
        {
            $('.colors_'+x).prop('disabled', false);
        }
    }

    function get_attribute(x)
    {
        var category_ids=$('#category_id').val();
        $.ajax({
            type: 'GET',
            url: "{{route('admin.get.attributes.by.category','')}}/"+category_ids,
            success: function(data) {
                $('#attribute_'+x).empty();
                $.each(data, function(key, val) {
                    $('#attribute_'+x).append("<option value=" +val.id+ ">"+val.name+"</option>");
                });
            }
        });
    }
    function get_attribute_value(x)
    {
        var attr_val=$('#attribute_'+x).val();
        $.ajax({
            type: 'GET',
            url: "{{route('admin.get.attribute.value','')}}/"+attr_val,
            success: function(data) {
                $('#attr_val_div_'+x).contents().remove();
                $.each(data, function(key, val) {
                    var values='';
                    $.each(val.value, function(k, v) {
                        values+='<option>'+v+'</option>';
                    });
                    $('#attr_val_div_'+x).append('<div class="col-md-4 form_div">'+
                                                    '<div class="input-group mb-3">'+
                                                        '<div class="input-group-prepend">'+
                                                            '<label class="input-group-text" for="inputGroupSelect01">'+val.name+'</label>'+
                                                        '</div>'+
                                                        '<select class="custom-select select2" name="choice_option_'+x+'[]" required>'+
                                                            '<option value="">Choose...</option>'+
                                                            values+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>');
                });
            }
        });

    }

</script>

