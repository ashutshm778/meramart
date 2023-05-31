<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brnad extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'descrption',
        'icon',
        'cat_id',
        'cat_img',
        'is_active',
        'meta_name',
        'meta_descrption',
    ];

    protected $casts = [
        'cat_id' => 'array',
        'cat_img' => 'array',
    ];

}
