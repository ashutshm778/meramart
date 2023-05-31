<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'type',
        'title',
        'description',
        'image',
        'start_date_time',
        'end_date_time',
        'is_active',
        'is_featured'
    ];

    public function offer_product()
    {
        return $this->hasMany(OfferProduct::class);
    }

}
