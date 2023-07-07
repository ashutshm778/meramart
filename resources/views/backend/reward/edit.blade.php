@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.reward.index')}}">Reward List</a></li>
                            <li class="breadcrumb-item active">Add Reward</li>
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
                                    <form action="{{route('admin.reward.update',encrypt($reward->id))}}" method="POST" class="form-example">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="name">Reward Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{$reward->name}}" placeholder="Reward Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="total_id">100% ID</label>
                                                        <input type="number" class="form-control" id="total_id" name="total_id" value="{{$reward->total_id}}" placeholder="100% ID...">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="one_side_id">1 Site (60%)</label>
                                                        <input type="number" class="form-control" id="one_side_id" name="one_side_id" value="{{$reward->one_side_id}}" placeholder="1 Site (60%)...">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="other_side_id">Other Site (40%)</label>
                                                        <input type="number" class="form-control" id="other_side_id" name="other_side_id" value="{{$reward->other_side_id}}" placeholder="Other Site (40%)...">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="product_name">R. Product</label>
                                                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{$reward->product_name}}" placeholder="R. Product...">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="amount">Reward</label>
                                                        <input type="number" class="form-control" id="amount" name="amount" value="{{$reward->amount}}" placeholder="Reward...">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-outline-warning mt-1 mb-1" onclick="return confirm('Are you sure you want to Update this Reward?');"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
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

