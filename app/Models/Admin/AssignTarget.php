<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by',
        'sales_member_id',
        'month',
        'year',
        'target_amount',
        'achive_target_amount'
    ];

}
