<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'image',
        'link_type',
        'link_id',
    ];

}
