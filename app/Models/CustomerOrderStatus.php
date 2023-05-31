<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'order_id',
        'product_id',
        'order_status'
    ];
}
