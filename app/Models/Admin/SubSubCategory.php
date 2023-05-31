<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSubCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'category_id',
        'subcategory_id',
        'image',
        'descrption',
        'is_active',
        'meta_name',
        'meta_descrption',
    ];

    protected $casts = [
        'category_id' => 'array',
        'subcategory_id' => 'array',
    ];

}
