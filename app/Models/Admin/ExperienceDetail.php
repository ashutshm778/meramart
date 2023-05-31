<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'institute_name',
        'designation',
        'from_date',
        'to_date',
        'Year_of_exp',
        'starting_salary',
        'ending_salary',
        'attachment',
    ];
}
