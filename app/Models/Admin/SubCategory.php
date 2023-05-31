<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'category_id',
        'descrption',
        'is_active',
        'meta_name',
        'meta_descrption',
    ];

    protected $casts = [
        'category_id' => 'array',
    ];

}
