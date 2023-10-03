<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class HomeController extends Controller


{
    public function home_product()  {

        return view('pages.index');
    }
}
