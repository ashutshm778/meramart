<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'gender',
        'adhar_number',
        'adhar_front_image',
        'adhar_back_image',
        'pan_number',
        'pan_image',
        'profile_image',
        'marital_status',
        'address'
    ];
}
