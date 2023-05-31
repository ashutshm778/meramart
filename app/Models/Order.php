<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'staff_id',
        'grand_total',
        'total_product_discount',
        'coupon_discount',
        'wallet_discount',
        'shipping_address',
        'payment_type',
        'payment_details',
        'payment_status',
        'remark',
        'shippment_id',
    ];

    public function order_details(){
        return $this->hasMany(OrderDetail::class,'order_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'user_id');
    }

}
