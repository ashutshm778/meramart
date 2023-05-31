<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Offer;
use Illuminate\Http\Request;
use App\Models\Admin\OfferProduct;
use App\Http\Controllers\Controller;

class OfferProductController extends Controller
{

    public function saveOffersProducts(Request $request)
    {
        $offer = new Offer;
        $offer->type = $request->product_type;
        $offer->title = $request->offer_name;
        $offer->description = $request->description;
        $offer->image = $request->icon;
        $offer->start_date_time = $request->start_date;
        $offer->end_date_time = $request->end_date;
        $offer->save();

        foreach($request->ids as $key=>$id)
        {
            $offer_product = new OfferProduct;
            $offer_product->offer_id = $offer->id;
            $offer_product->product_id = $id;
            $offer_product->product_price = $request->product_selling_price[$key];
            $offer_product->product_offer_price = $request->values[$key];
            $offer_product->save();
        }

    }

    public function updateOffersProducts(Request $request,$offer_id)
    {
        //return $request->all();
        $offer = Offer::find($offer_id);
        $offer->type = $request->product_type;
        $offer->title = $request->offer_name;
        $offer->description = $request->description;
        $offer->image = $request->icon;
        $offer->start_date_time = $request->start_date;
        $offer->end_date_time = $request->end_date;
        $offer->save();

        foreach($request->ids as $key=>$id)
        {
            $offer_product = OfferProduct::where('offer_id',$offer_id)->where('product_id',$id)->first();
            if($offer_product)
            {
                $offer_product=$offer_product;
            }
            else
            {
                $offer_product = new OfferProduct;
            }
            $offer_product->offer_id = $offer_id;
            $offer_product->product_id = $id;
            $offer_product->product_price = $request->product_selling_price[$key];
            $offer_product->product_offer_price = $request->values[$key];
            $offer_product->save();
        }

        $exists_product = OfferProduct::where('offer_id',$offer_id)->pluck('product_id');
        $new_product = $request->ids;
        if(count($exists_product) < count($new_product))
        {
            $delete_product = array_diff($new_product,$exists_product->toArray());
        }
        else
        {
            $delete_product = array_diff($exists_product->toArray(),$new_product);
        }
        OfferProduct::where('offer_id',$offer_id)->whereIn('product_id',array_values($delete_product))->delete();
    }

}
