<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealerOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_price',
        'discount_price',
        'final_price',
        'quantity',
        'product_order_status',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
