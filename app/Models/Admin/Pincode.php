<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'state_id',
        'city_id',
        'pincode'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

}
