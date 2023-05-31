<?php

namespace App\CPU;

use Illuminate\Support\Str;
use App\Models\Admin\Coupon;

class CouponManager
{

    public static function withoutTrash()
    {
        return Coupon::where('is_delete','0');
    }

}
