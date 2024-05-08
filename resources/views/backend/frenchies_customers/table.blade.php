<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Phone</th>
            <th class="text-center">Address</th>
            <th class="text-center">Bank Detail</th>
            <th class="text-center">Date</th>
           <th class="text-center">Veification Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($customers as $key=>$customer)
            <tr>
                <td class="text-center">{{($key+1) + ($customers->currentPage() - 1)*$customers->perPage()}}</td>
                <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                <td class="text-center">{{$customer->phone}}</td>
                <td class="text-center">{{$customer->address}}</td>
                <td class="text-center">
                    @if(!empty($customer->account_number))
                    Bank Name:{{$customer->bank_name}}<br>
                    Account Number:{{$customer->account_number}}<br>
                    IFSC Code:{{$customer->ifsc_code}}
                    @endif
                </td>
                <td class="text-center">{{$customer->created_at}}</td>
                <td class="text-center">
                    <div class="custom-control custom-switch">
                         @if($customer->verify_status==1)
                        <p style="color:green"> {{'Active'}}</p>
                         @else
                        <p style="color:red"> {{'InActive'}}</p>
                          @endif

                    </div>
                </td>
                <td class="text-center">
                    <a href="{{route('admin.customer.reward.list',encrypt($customer->id))}}" class="btn btn-outline-warning btn-sm mr-1 mb-1" title="Reward" style="width: 34px;"><i class="fas fa-award"></i></a>
                    <a href="{{route('admin.customer.payout',encrypt($customer->id))}}" class="btn btn-outline-success btn-sm mr-1 mb-1" title="Payouts"><i class="fas fa-money-bill"></i></a>
                    <a href="{{route('admin.customer.level.income',encrypt($customer->id))}}" class="btn btn-outline-primary btn-sm mr-1 mb-1" title="Level Income" style="width: 34px;"><i class="fas fa-level-up-alt"></i></a>
                    <a href="{{route('admin.customer_login',encrypt($customer->id))}}" target="_blank" class="btn btn-outline-primary btn-sm mr-1 mb-1" title="Customer Login" style="width: 34px;"><i class="fas fa-level-up-alt"></i></a>
                    @if($customer->verify_status!=1)
                    <a href="{{route('admin.customers.destroy',$customer->id)}}"  class="btn btn-outline-danger btn-sm mr-1 mb-1" title="Customer Delete" style="width: 34px;"><i class="fas fa-trash"></i></a>
                    @endif
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
<hr>
<div class="row" style="margin: 0px;">
    <div class="col-md-4">
        <p><b>Showing {{($customers->currentpage()-1)*$customers->perpage()+1}} to {{(($customers->currentpage()-1)*$customers->perpage())+$customers->count()}} of {{$customers->total()}} Customers</b></p>
    </div>
    <div class="col-md-8 d-flex justify-content-end">
        {!! $customers->appends(['search_key'=>$search_key,'search_date_range'=>$search_date_range])->links() !!}
    </div>
</div>

<script>
    $(function () {
        $('.page-link').on('click', function (event) {
            event.preventDefault()
            var url = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    $('#table').html(data)
                }
            });
        });
    });
</script>
