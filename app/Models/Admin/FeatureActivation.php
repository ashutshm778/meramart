<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureActivation extends Model
{
    use HasFactory;

    protected $fillable = [
        'feature_name',
        'is_active'
    ];
}
