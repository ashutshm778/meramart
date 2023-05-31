@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Sales Member</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="card card-outline card-info">
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sales_member">Sales Member</label>
                                                <select name="sales_member" id="sales_member" class="form-control select2" onchange="get_dealer_list()">
                                                    <option value="">Select Sales Member...</option>
                                                    @foreach ($sales_members as $sales_member)
                                                        <option value="{{$sales_member->id}}">{{$sales_member->name}} ({{$sales_member->phone}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Dealers List</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    <div class="card-body table-responsive p-2">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Dealer</th>
                                                    <th class="text-center">Sales Member</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dealers_list"></tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-outline-success mt-1 mb-1" onclick="save()"> Save</button>
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
@endsection

<script>

    function get_dealer_list()
    {
        var sales_member_id=$('#sales_member').val();

        $.ajax({
            url: '{{ route('admin.get.dealers.list','') }}/'+sales_member_id,
            type: 'GET',
            contentType: false,
            processData: false,
            success: function(data) {
                $('#dealers_list').html(data);
            }
        })
    }

    function save()
    {
        var sales_member=$('#sales_member').val();
        var assign_dealers = $('input[name^=dealer_id]:checked').map(function(idx, elem) {
            return $(elem).val();
        }).get();

        $.ajax({
            url: '{{ route('admin.assign.dealer.store') }}',
            type: 'POST',
            data:{
                _token:'{{csrf_token()}}',
                sales_member:sales_member,
                assign_dealers:assign_dealers
            },
            success: function(data) {
                window.location.replace("{{route('admin.assign.dealer.index')}}");
            }
        })
    }

</script>
