<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'code'
    ];

    public function product()
    {
        return $this->hasMany(Product::class,'colors','code');
    }
}
