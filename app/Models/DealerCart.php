<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealerCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_member_id',
        'dealer_id',
        'product_id',
        'quantity',
    ];

    public function dealer()
    {
        return $this->belongsTo(Customer::class,'dealer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
