<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'value',
    ];

    protected $casts = [
        'category_id' => 'array',
        'value' => 'array',
    ];

}
