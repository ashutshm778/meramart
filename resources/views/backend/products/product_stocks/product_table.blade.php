@if (count($offer_products))
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Image</th>
                <th class="text-center">Product Name</th>
                <th class="text-center">Total Stock</th>
                @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                <th class="text-center">Selling Price</th>
                @endif
                <th class="text-center">Purchase Price</th>
                <th class="text-center">MRP Price</th>
                <th class="text-center">Purchase Stock</th>
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
                    <td class="text-center">@if($offer_product->variant_name){{$offer_product->variant_name}}@else{{$offer_product->name}}@endif</td>
                    <td class="text-center">{{$offer_product->retailer_selling_price}}</td>
                    @if(featureActivation('retailer') == '1' || featureActivation('distributor') == '1' || featureActivation('wholeseller') == '1')
                    <td class="text-center">
                        @if(featureActivation('retailer') == '1')
                            <label>Retailer</label>
                            <input type="number" step="0.01" name="retailer_selling_price[]" value="{{$offer_product->retailer_selling_price}}" class="form-control" required>
                        @endif
                        @if(featureActivation('distributor') == '1')
                            <label>Distributor</label>
                            <input type="number" step="0.01" name="distributor_selling_price[]" value="{{$offer_product->distributor_selling_price}}" class="form-control" required>
                        @endif
                        @if(featureActivation('wholeseller') == '1')
                            <label>Woleseller</label>
                            <input type="number" step="0.01" name="wholeseller_selling_price[]" value="{{$offer_product->wholeseller_selling_price}}" class="form-control" required>
                        @endif
                    </td>
                    @endif
                    <td class="text-center">
                        <input type="hidden" name="product_ids[]" value="{{$offer_product->id}}">
                        <input type="number" step="0.01" name="purchase_prices[]" class="form-control" required>
                    </td>
                    <td class="text-center">
                        <input type="number" step="0.01" name="mrp_prices[]" class="form-control" required>
                    </td>
                    <td>
                        <input type="number" name="stockes[]" class="form-control" required>
                    </td>
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
