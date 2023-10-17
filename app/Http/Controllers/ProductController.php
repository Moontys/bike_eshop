<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;




class ProductController extends Controller


{
    public function addProduct()
    {
        return view('admin.add_product');
    }
        
    public function allProducts()
    {
        return view('admin.all_products');
    }
    
}