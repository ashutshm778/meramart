<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'owner_name',
        'contact_name',
        'phone',
        'email',
        'business_name',
        'gstin',
        'address',
        'account_holder_name',
        'account_number',
        'ifsc_code',
        'branch_name',
    ];
}
