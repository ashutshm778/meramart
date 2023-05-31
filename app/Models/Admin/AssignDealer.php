<?php

namespace App\Models\Admin;

use App\Models\Customer;
use App\Models\Admin\BusinessDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignDealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_member_id',
        'dealer_id'
    ];

    public function dealer()
    {
        return $this->belongsTo(Customer::class,'dealer_id');
    }
    
}
