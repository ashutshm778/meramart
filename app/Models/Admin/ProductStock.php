<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'pi_number',
        'vendor_id',
        'product_id',
        'purchase_price',
        'mrp_price',
        'current_stock'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
