<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bicycle;



class HomeController extends Controller


{



    public function homePageAndTopBicycles()  {

        $products = Bicycle::all();

        return view('pages.index')->with('products', $products);
    }



    public function displayBicycle($id)    {

        $product = Bicycle::find($id);

        return view('pages.bicycle')->with('product', $product);    // Daug klausimų!!!!!!!!!!
    }




    public function allBicycles()  {

        return view('pages.all_bicycles');
    }
}


