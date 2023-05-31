<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'mrp_price',
        'price',
        'discounted_price',
        'tax',
        'shipping_cost',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
