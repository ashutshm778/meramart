<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Admin\BusinessDetail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'type',
        'password',
        'photo',
        'verify_status',
    ];

    protected $hidden = [
        'password',
    ];

    public function businessDetail()
    {
        return $this->belongsTo(BusinessDetail::class,'id','customer_id');
    }

}
