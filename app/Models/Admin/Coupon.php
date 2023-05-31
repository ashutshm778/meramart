<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'code',
        'image',
        'description',
        'product_ids',
        'minimum_order_value',
        'maximum_discount_amount',
        'discount',
        'discount_type',
        'start_date',
        'end_date',
        'number_of_usages',
        'is_active',
        'is_delete',
    ];
}
