<style>

.table-responsivew {
    display: block;
    height: 400px;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

</style>

<div class="table-responsive table-responsivew pt-1">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th># </th>
                <th><input type="checkbox" name="check" id="selectAll" /></th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Variant Name</th>
                <th>Total Stock</th>
                <th>Base Price</th>
                <th>Discounted Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 + ($products->currentPage() - 1) * $products->perPage() }}</td>
                    <td>
                        <input type="checkbox" class="save-cb-state check_select" id="product_{{$product->id}}" name="check" value="{{$product->id}}" onclick="save_local_data('product',{{$product->id}})">
                    </td>
                    <td>
                        <img src="{{asset('public/'.api_asset($product->thumbnail_image))}}" style="height: 60px; width: 75px;" alt="Image">
                    </td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        asdasd
                    </td>
                    <td>
                        2
                    </td>
                    <td>{{$product->retailer_selling_price}}</td>
                    <td>232323</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        @include('backend.pagination',['list' =>$products,'class'=>'product_index'])
    </div>
</div>

