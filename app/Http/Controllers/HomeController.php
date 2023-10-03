<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class HomeController extends Controller


{
    public function homeAndProduct()  {

        return view('pages.index');
    }
}
