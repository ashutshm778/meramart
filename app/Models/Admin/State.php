<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'state'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

}
