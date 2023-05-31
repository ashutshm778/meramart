<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
       'type',
       'position',
        'image',
        'link_type',
        'link_id',
    ];
}
