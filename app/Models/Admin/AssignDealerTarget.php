<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignDealerTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by',
        'dealer_id',
        'month',
        'year',
        'target_amount',
        'achive_target_amount'
    ];

}
