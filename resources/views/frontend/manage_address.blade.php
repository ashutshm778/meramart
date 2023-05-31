@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Manage Address</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Address</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                @include('frontend.user_sidebar')
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <center><h2>Manage Address</h2></center>
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="alert alert-danger" style="color: #ffffff;background-color: #b30606bd;border-color: #530000;">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                @foreach (App\Models\CustomerAddress::where('user_id',Auth::guard('customer')->user()->id)->get() as $customer_address)
                                    <div class="col-md-6 pt-4">
                                        <div class="card" style="padding: 10px;">
                                            <div>
                                                <b>Name: </b>{{$customer_address->name}} <br>
                                            </div>
                                            <div>
                                                <b>Country: </b>{{$customer_address->country}} <br>
                                            </div>
                                            <div>
                                                <b>State: </b>{{App\Models\Admin\State::where('id',$customer_address->state)->first()->state}} <br>
                                            </div>
                                            <div>
                                                <b>City: </b>{{App\Models\Admin\City::where('id',$customer_address->city)->first()->city}} <br>
                                            </div>
                                            <div>
                                                <b>Pincode: </b>{{$customer_address->pincode}} <br>
                                            </div>
                                            <div>
                                                <b>Phone: </b>{{$customer_address->phone}} <br>
                                            </div>
                                            <div>
                                                <b>Address: </b>{{$customer_address->address}}<br>
                                            </div>
                                            <div class="ec-header-user dropdown" style="position: absolute;right: 0;">
                                                <button class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <img src="{{ asset('public/frontend/assets/images/icons/dots.png') }}" class="svg_img header_svg">
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a class="dropdown-item" onclick="edit_address({{$customer_address->pincode}},{{$customer_address->phone}},'{{$customer_address->address}}',{{$customer_address->id}},'{{$customer_address->name}}')">Edit</a></li>
                                                    <li><a class="dropdown-item" href="{{route('delete.customer.address',$customer_address->id)}}">Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-6 pt-4">
                                    <div class="card" style="padding: 15.6%;">
                                        <a onclick="add_update_address('add')"><i class="ecicon eci-plus cursor-pointer" style="margin-left: 45%;font-size: 45px;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body" id="modal_body">
                    <h3 id="header_text">Add Address</h3>
                    <form action="{{route('store.customer.address')}}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="id">
                            <div class="col-md-4">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                            </div>
                            <div class="col-md-4">
                                <label>Pincode</label>
                                <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Pincode" onchange="get_address()" required>
                            </div>
                            <div class="col-md-4">
                                <label>City</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="City" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label>State</label>
                                <input type="text" class="form-control" name="state" id="state" placeholder="State" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label>Country</label>
                                <input type="text" class="form-control" name="country" id="country" placeholder="Country" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label>Phone</label>
                                <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone" required>
                            </div>
                            <div class="col-md-12">
                                <label>Address</label>
                                <textarea type="text" class="form-control" name="address" id="address" placeholder="Address" required></textarea>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-center">
                                <button class="btn btn-primary" id="button">Add</button>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>

    function add_update_address(type)
    {
        $('#button').text('Add')
        $('#header_text').text('Add Address')
        $('#myModal').modal('show')
        $('#pincode').val('')
        $('#city').val('')
        $('#state').val('')
        $('#country').val('')
        $('#phone').val('')
        $('#address').val('')
        $('#id').val('')
        $('#name').val('')
    }

    function edit_address(pincode,phone,address,id,name)
    {
        $('#myModal').modal('show')
        $('#button').text('Update')
        $('#header_text').text('Update Address')
        $.get("{{route('get.address.by.pincode','')}}"+"/"+pincode, function(data)
        {
            if(data)
            {
                $('#pincode').val(pincode)
                $('#city').val(data.city.city)
                $('#state').val(data.state.state)
                $('#country').val(data.country.country)
                $('#phone').val(phone)
                $('#address').val(address)
                $('#id').val(id)
                $('#name').val(name)
            }
            else
            {
                alert('You have Enter Wrong Pincode!')
            }
        }).fail(function()
        {
            alert('You have Enter Wrong Pincode!')
        });
    }

    function get_address()
    {
        var pincode = $('#pincode').val()
        $.get("{{route('get.address.by.pincode','')}}"+"/"+pincode, function(data)
        {
            if(data)
            {
                $('#city').val(data.city.city)
                $('#state').val(data.state.state)
                $('#country').val(data.country.country)
            }
            else
            {
                $('#city').val('')
                $('#state').val('')
                $('#country').val('')
                $('#id').val('')
                $('#name').val('')
                alert('You have Enter Wrong Pincode!')
            }
        }).fail(function()
        {
            alert('You have Enter Wrong Pincode!')
        });
    }

</script>
