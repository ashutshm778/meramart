<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualificationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qualification',
        'university',
        'institute_name',
        'year_of_passing',
        'percentage',
        'marks_memo',
    ];
}
