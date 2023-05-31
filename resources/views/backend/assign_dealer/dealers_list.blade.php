@foreach ($final_dealers as $final_dealer)
    @php
        $exist=App\Models\Admin\AssignDealer::where('sales_member_id',$sales_member_id)->where('dealer_id',$final_dealer)->first();
    @endphp
    <tr>
        <td class="text-center">
            <input type="checkbox" name="dealer_id[]" value="{{$final_dealer}}" @if($exist) checked @endif>
        </td>
        @php
            $dealer=App\Models\Customer::where('id',$final_dealer)->first();
            $sales_member=App\Models\User::where('id',$sales_member_id)->first();
        @endphp
        <td class="text-center">{{$dealer->first_name}} ({{$dealer->phone}}) - {{ucwords(str_replace('_',' ',$dealer->type))}}</td>
        <td class="text-center">{{$sales_member->name}} ({{$sales_member->phone}})</td>
@endforeach

