<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessPersonRequest extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'type',
        'business_name',
        'brand_name',
        'owner_name',
        'gstin_number',
        'gstin_document',
        'address',
        'verify_status',
    ];

}
