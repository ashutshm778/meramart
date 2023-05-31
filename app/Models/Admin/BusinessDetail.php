<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'business_name',
        'brand_name',
        'owner_name',
        'gst_number',
        'gst_document',
        'address',
    ];
}
