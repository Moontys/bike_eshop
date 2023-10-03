<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class ContactController extends Controller


{
    public function contact() {

        return view('pages.contact');
    }



    public function bikeRepair() {

        return view('pages.need_a_bike_repair');
    }
}
