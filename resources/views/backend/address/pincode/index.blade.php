@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Pincode List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <form action="{{route('admin.pincodes.index')}}">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select name="search_country" class="form-control select2">
                                                <option value="">Select Country</option>
                                                @foreach (App\Models\Admin\Country::orderBy('country','asc')->get() as $country)
                                                    <option value="{{$country->id}}" @if($search_country == $country->id) selected @endif>{{$country->country}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="search_state" class="form-control select2">
                                                <option value="">Select State</option>
                                                @foreach (App\Models\Admin\State::orderBy('state','asc')->get() as $state)
                                                    <option value="{{$state->id}}" @if($search_state == $state->id) selected @endif>{{$state->state}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="search_city" class="form-control select2">
                                                <option value="">Select City</option>
                                                @foreach (App\Models\Admin\City::orderBy('city','asc')->get() as $city)
                                                    <option value="{{$city->id}}" @if($search_city == $city->id) selected @endif>{{$city->city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 input-group input-group-sm">
                                            <input type="text" name="search" value="{{$search}}" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Country</th>
                                            <th class="text-center">State</th>
                                            <th class="text-center">City</th>
                                            <th class="text-center">Pincode</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pincodes as $key=>$pincode)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($pincodes->currentPage() - 1)*$pincodes->perPage()}}</td>
                                                <td class="text-center">{{$pincode->country->country}}</td>
                                                <td class="text-center">{{$pincode->state->state}}</td>
                                                <td class="text-center">{{$pincode->city->city}}</td>
                                                <td class="text-center">{{$pincode->pincode}}</td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.pincodes.edit',$pincode->id).'?search='.$search.'&search_country='.$search_country.'&search_state='.$search_state.'&search_city='.$search_city.'&page='.$pincodes->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.pincodes.destroy',$pincode->id).'?search='.$search.'&search_country='.$search_country.'&search_state='.$search_state.'&search_city='.$search_city.'&page='.$pincodes->currentPage()}}" onclick="return confirm('Are you sure you want to delete this Pincode?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
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
                                    {!! $pincodes->appends(['search'=>$search,'search_country'=>$search_country,'search_state'=>$search_state,'search_city'=>$search_city])->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Add Pincode</h3>
                            </div>
                            <div class="card-body p-2">
                                <form action="{{route('admin.pincodes.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            @isset($edit_data) <input type="hidden" name="id" value="{{$edit_data->id}}"> @endisset
                                            <label>Country</label>
                                            <select name="country_id" id="country_id" class="form-control select2" onchange="get_state()" required>
                                                <option value="">Select Country</option>
                                                @foreach (App\Models\Admin\Country::orderBy('country','asc')->get() as $country)
                                                    <option value="{{$country->id}}" @isset($edit_data) @if($edit_data->country_id == $country->id) selected @endif @endisset>{{$country->country}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>State</label>
                                            <select name="state_id" id="state_id" class="form-control select2" onchange="get_city()" required>
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>City</label>
                                            <select name="city_id" id="city_id" class="form-control select2" required>
                                                <option value="">Select City</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Pincode</label>
                                        <input type="text" name="pincode" class="form-control" @isset($edit_data) value="{{$edit_data->pincode}}" @endisset placeholder="Enter Pincode Name..." required>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 text-center pt-4">
                                            <button class="btn btn-primary">@isset($edit_data) Update @else Add @endisset</button>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </form>
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

    @isset($edit_data)
        setTimeout(
        function()
        {
            $(get_state());
        }, 500);
    @endisset

    function get_state()
    {
        var country_id = $('#country_id').val();

        $.ajax({
            type: 'GET',
            url: "{{route('admin.get.states','')}}/"+country_id,
            success: function(data) {
                $('#state_id').empty();
                $('#state_id').append('<option value="">Select State</option>');
                $.each(data, function(key, val) {
                    @isset($edit_data)
                        var edit_state = "{{$edit_data->state_id}}";
                        if(val.id == edit_state){
                            $('#state_id').append('<option value="'+ val.id +'" selected>'+ val.state +'</option>');
                        }
                        else
                        {
                            $('#state_id').append('<option value="'+ val.id +'">'+ val.state +'</option>');
                        }
                    @else
                        $('#state_id').append('<option value="'+ val.id +'">'+ val.state +'</option>');
                    @endisset
                });
                get_city();
            }
        });
    }

    function get_city()
    {
        var state_id = $('#state_id').val();
        $.ajax({
            type: 'GET',
            url: "{{route('admin.get.cities','')}}/"+state_id,
            success: function(data) {
                $('#city_id').empty();
                $('#city_id').append('<option value="">Select City</option>');
                $.each(data, function(key, val) {
                    @isset($edit_data)
                        var edit_city = "{{$edit_data->city_id}}";
                        if(val.id == edit_city){
                            $('#city_id').append('<option value="'+ val.id +'" selected>'+ val.city +'</option>');
                        }
                        else
                        {
                            $('#city_id').append('<option value="'+ val.id +'">'+ val.city +'</option>');
                        }
                    @else
                        $('#city_id').append('<option value="'+ val.id +'">'+ val.city +'</option>');
                    @endisset
                });
            }
        });
    }

</script>
