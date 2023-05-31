<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_request_id',
        'sales_member_id',
        'ordered_by',
        'dealer_id',
        'grand_total',
        'total_discount',
        'address',
        'order_status',
    ];

    public function dealer(){
        return $this->belongsTo(Customer::class,'dealer_id');
    }

    public function orderDetail(){
        return $this->hasMany(DealerOrderDetail::class,'order_id','id');
    }

    public function sales_member(){
        return $this->belongsTo(User::class,'sales_member_id');
    }
}
