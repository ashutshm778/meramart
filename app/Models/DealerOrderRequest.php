<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealerOrderRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_request_id',
        'sales_member_id',
        'dealer_id',
        'product_id',
        'product_price',
        'product_discount_type',
        'product_discount',
        'product_discount_amount',
        'product_quantity',
        'request_status',
    ];

    public function dealer(){
        return $this->belongsTo(Customer::class,'dealer_id');
    }

    public function sales_member(){
        return $this->belongsTo(User::class,'sales_member_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
