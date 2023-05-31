<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifyDelearOrderRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_request_id',
        'modify_order_request_id',
        'product_id',
        'product_price',
        'product_discount',
        'product_discount_amount',
        'product_quantity',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
