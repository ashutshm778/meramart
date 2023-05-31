<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'descrption',
        'commision',
        'icon',
        'banner',
        'is_feature',
        'is_active',
        'priority',
        'nav_priority',
        'top_priority',
        'bottom_priority',
        'meta_name',
        'meta_descrption',
    ];

}
