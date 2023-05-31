<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealerController extends Controller
{
    public function index()
    {
        $dealers = Customer::where('type','!=','retailer')->paginate(10);

        return view('backend.dealers.index',compact('dealers'),['page_title'=>'Dealer List']);
    }
}
