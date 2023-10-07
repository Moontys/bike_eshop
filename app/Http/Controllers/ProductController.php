<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//use Session;
use Illuminate\Support\Facades\Session;




class ProductController extends Controller


{

    public function addBicycle()    {

        return view('pages.add_bicycle');
    }


    public function saveAddedBicycle(Request $request)   {

        $product = new Bicycle();
        $product->bicycle_brand = $request->product_brand;
        $product->bicycle_price = $request->product_price;
        $product->bicycle_description = $request->product_description;

        $product->save();

        Session::put('success', 'The Product Has Been Added Successfully!');

        return redirect('/add-product');


    }



}