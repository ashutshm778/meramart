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
        'referral_code',
        'payout',
        'refered_by',
        'verify_status',
        'bank_account_name',
        'branch',
        'ifsc_code',
        'account_number',
        'bank_name',
        'address',
        'pv',
        'nominee_name',
        'nominee_relation',
        'nominee_dob'
    ];

    protected $hidden = [
        'password',
    ];

    public function businessDetail()
    {
        return $this->belongsTo(BusinessDetail::class,'id','customer_id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'user_id','id');
    }

}
