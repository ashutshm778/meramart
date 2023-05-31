@if (count($offer_products))
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Image</th>
                <th class="text-center">Product Name</th>
                <th class="text-center">Base Price</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offer_products as $key=>$offer_product)
                <tr>
                    <td class="text-center">{{$key+1}}</td>
                    <td class="text-center">
                        <img src="{{asset('public/'.api_asset($offer_product->thumbnail_image))}}" style="height:80px;width: 80px;margin-right: 10px;">
                    </td>
                    <td class="text-center">
                        @if($offer_product->variant_name)
                            {{$offer_product->variant_name}}
                        @else
                            {{$offer_product->name}}
                        @endif
                    </td>
                    <input type="hidden" name="product_ids[]" value="{{$offer_product->id}}">
                    <td class="text-center">{{$offer_product->retailer_selling_price}}</td>
                    <td class="text-center">
                        <a onclick="remove_local_data('product',{{$offer_product->id}})"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
