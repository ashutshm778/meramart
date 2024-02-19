@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Payout List</li>
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
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Email</th>
                                            <th>Bank Details</th>
                                            {{-- <th class="text-center">Total Amount</th> --}}
                                            <th class="text-center">Remainig Amount</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($customers as $key=>$customer)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($customers->currentPage() - 1)*$customers->perPage()}}</td>
                                                <td class="text-center">{{$customer->first_name}} {{$customer->last_name}}</td>
                                                <td class="text-center">{{$customer->phone}}</td>
                                                <td class="text-center">{{$customer->email}}</td>
                                                <td class="text-center">
                                                    @if(!empty($customer->account_number))
                                                    Bank Name:{{$customer->bank_name}}<br>
                                                    Account Number:{{$customer->account_number}}<br>
                                                    IFSC Code:{{$customer->ifsc_code}}
                                                    @endif
                                                </td>
                                                </td>
                                                {{-- <td class="text-center">{{$customer->balance + $customer->payout}}</td> --}}
                                                <td class="text-center">{{$customer->balance}}</td>
                                                <td class="text-center">
                                                    @if($customer->total_pv > 39)
                                                    <a class="btn btn-outline-success btn-sm mr-1 mb-1" onclick="payout({{$customer->id}},{{$customer->balance}},'{{$customer->first_name}}','{{$customer->last_name}}','{{$customer->phone}}')">
                                                        <i class="fas fa-money-bill"></i>
                                                    </a>
                                                    @endif
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
                                    {!! $customers->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="payout">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer Payout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.payout.store')}}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="customer_id" id="customer_id">
                        <label for="customer_detail">Customer</label>
                        <input type="text" id="customer_detail" class="form-control" readonly>
                        <label for="amount" class="mt-2">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Pay</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        function payout(customer_id,amount,first_name,last_name,phone){
            $('#payout').modal('show')
            $('#customer_detail').val(first_name+' '+last_name+' ('+phone+')')
            $('#amount').val(amount)
            $('#amount').attr('max',amount)
            $('#customer_id').val(customer_id)
        }

    </script>

@endsection
