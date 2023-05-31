<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Attribute;

class ProductController extends Controller
{

    public function productDetail($slug)
    {
        $data = Product::where('slug', $slug)->first();
        $product_attribut_array = [];
        foreach ($data->attribute as $key => $attr) {
            array_push($product_attribut_array, [$attr, $data->attribute_value[$key]]);
        }

        return view('frontend.product-details', compact('data'));
    }

    public function modalProductDetail(Request $request, $id)
    {
        $data = Product::where('id', $id)->first();
        $product_attribut_array = [];
        if (is_array($data->attribute)) {
            foreach ($data->attribute as $key => $attr) {
                array_push($product_attribut_array, [$attr, $data->attribute_value[$key]]);
            }
        }
        $product_quanity = $request->product_qty;
        $total_price = homePrice($data->id)['p_p'] * $product_quanity;
        return view('frontend.product_detail_model', compact('data', 'product_attribut_array', 'product_quanity', 'total_price'))->render();
    }

    public function get_varinat_price(Request $request)
    {

        $data = Product::where('id', $request->product_id)->first();
        $product_attribut_array = [];
        if (is_array($data->attribute)) {
            foreach ($data->attribute as $key => $attr) {
                array_push($product_attribut_array, [$attr, $data->attribute_value[$key]]);
            }
        }
        $product_quanity = $request->product_qty;
        $total_price = homePrice($data->id)['p_p'] * $product_quanity;
        //return $product_attribut_array;
        if (!empty($request->type == 'model')) {
            return view('frontend.product_detail_model', compact('data', 'product_attribut_array', 'product_quanity', 'total_price'))->render();
        }
        return view('frontend.product_variant', compact('data', 'product_attribut_array', 'product_quanity', 'total_price'));
    }

    public function get_selected_variant(Request $request)
    {
        if (!empty($request->color)) {
            $product_data = Product::where('product_group_id', $request->product_group_id)->where('colors', $request->color)->first();
            $data = Product::find($product_data->id);
        }
        return view('frontend.product_variant', compact('product_data', 'data'))->render();
    }


    public function get_variant_price_data(Request $request)
    {
        $id = 0;
        if (empty($request->color)) {
            $product = Product::where('product_group_id', $request->product_group_id)->whereJsonContains('attribute', '' . $request->attribute_id)->get();
            foreach ($product as $pro) {
                foreach ($pro->attribute as $key => $attr) {
                    if ($attr == $request->attribute_id) {
                        if ($pro->attribute_value[$key] == $request->attribute_value) {
                            $id = $pro->id;
                        }
                    }
                }
            }
            $data = Product::where('id', $id)->first();
        } else {
            $data = Product::where('product_group_id', $request->product_group_id)->where('colors', $request->color)->first();
        }

        $product_attribut_array = [];
        if (is_array($data->attribute)) {
            foreach ($data->attribute as $key => $attr) {
                array_push($product_attribut_array, [$attr, $data->attribute_value[$key]]);
            }
        }
        $product_quanity = $request->product_qty;
        $total_price = homePrice($data->id)['p_p'] * $product_quanity;
        //return $product_attribut_array;
        if (!empty($request->type == 'model')) {
            return view('frontend.product_detail_model', compact('data', 'product_attribut_array', 'product_quanity', 'total_price'))->render();
        }
        return view('frontend.product_variant', compact('data', 'product_attribut_array', 'product_quanity', 'total_price'));
    }
}
