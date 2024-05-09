@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">
                                @isset($page_title)
                                    {{$page_title}}
                                @endisset
                            </li>
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
                            <div class="card-header">
                                <form id="search_form">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="search_date_range" class="form-control float-right" id="reservation" placeholder="Select Date Range..." onchange="fillter()">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="search_key" class="form-control float-right" placeholder="Search" onkeyup="fillter()">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body table-responsive p-2" id="table">
                                @include('backend.frenchies_customers.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal" tabindex="-1" role="dialog" id="payout">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Frenchies Add Money To Wallet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('admin.frenchies_customers.add_money_to_wallet')}}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="customer_id" id="customer_id">
                            <label for="amount" class="mt-2">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>

        function fillter(){
            $.ajax({
                type: 'GET',
                url: "{{route('admin.customers.index')}}",
                data: $('#search_form').serialize(),
                success: function(data) {
                    $('#table').html(data)
                }
            });
        }
        function update_verification(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post("{{ route('admin.customers.updateVerificationStatus') }}", {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    toastr.success('Customer Verified Successfully!')
                } else {
                    toastr.error('Customer UnVerified Successfully!')
                }
            });
        }

        function payout(customer_id){
            $('#payout').modal('show')
            $('#customer_id').val(customer_id)
        }

    </script>

@endsection
