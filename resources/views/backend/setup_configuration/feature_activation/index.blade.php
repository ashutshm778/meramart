@extends('backend.include.header')
<style>
    .card-header {
        text-align: center;
        padding: 0.5rem 0.5rem !important;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Feature Activations</li>
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
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <strong>Retailer</strong>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" value="retailer" class="click" @if(featureActivation('retailer') != '0') checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <strong>Distributor</strong>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" value="distributor" class="click" @if(featureActivation('distributor') != '0') checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <strong>Wholeseller</strong>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" value="wholeseller" class="click" @if(featureActivation('wholeseller') != '0') checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <strong>MLM</strong>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" value="mlm" class="click" @if(featureActivation('mlm') != '0') checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <strong>Purchase Vendor</strong>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" value="purchase_vendor" class="click" @if(featureActivation('purchase_vendor') != '0') checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <strong>Sales Team</strong>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" value="sales_team" class="click" @if(featureActivation('sales_team') != '0') checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <strong>Staff Management</strong>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" value="staff_management" class="click" @if(featureActivation('staff_management') != '0') checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <strong>App Setting</strong>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" value="app_setting" class="click" @if(featureActivation('app_setting') != '0') checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <strong>Offer</strong>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" value="offer" class="click" @if(featureActivation('offer') != '0') checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <strong>Coupon</strong>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" value="coupon" class="click" @if(featureActivation('coupon') != '0') checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>

        $(".click").click(function(){
            var feature = $(this).val();
            if($(this).prop('checked')){
                var status = '1'
            }else{
                var status = '0'
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{route('admin.feature.activation.store')}}",
                data:{
                    feature:feature,
                    status:status
                },
                success: function(data) {
                    if(status == '1'){
                        toastr.success('Activated')
                    }else{
                        toastr.error('Deactivated')
                    }
                }
            });
        })

    </script>

@endsection
