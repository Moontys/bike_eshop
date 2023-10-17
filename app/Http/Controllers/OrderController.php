<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller




{
    public function allOrders()
    {
        return view('admin.all_orders');
    }
}
