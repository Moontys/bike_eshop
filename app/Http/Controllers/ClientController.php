<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;



class ClientController extends Controller
{

    public function home()
    {
        $allSliders = Slider::All()->where('slider_status', 1);

        $allProducts = Product::All()->where('product_status', 1);

        return view('client.home')->with('allSlidersFromTableWhereId1', $allSliders)->with('allProductsFromTableWhereId1', $allProducts);
    }


    public function shop()
    {
        return view('client.shop');
    }

    public function cart()
    {
        return view('client.cart');
    }

    public function checkout()
    {
        return view('client.checkout');
    }

    public function login()
    {
        return view('client.login');
    }

    public function signup()
    {
        return view('client.signup');
    }


}
