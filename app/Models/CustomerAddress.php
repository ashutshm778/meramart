<?php

namespace App\Models;

use App\Models\Admin\City;
use App\Models\Admin\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'country',
        'state',
        'city',
        'pincode',
        'phone',
        'address',
        'address_type'
    ];

    public function state()
    {
        return $this->belongsTo(State::class,'state');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city');
    }
}
