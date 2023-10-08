<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Bicycle;




class AuthlikefornowController extends Controller



{
    public function adminLikeForNow()  {

        $products = Bicycle::all();

        return view('pages.admin_like_for_now_index')->with('products', $products);
    }




}
