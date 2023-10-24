<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;



class ClientController extends Controller
{

    public function home()
    {
        $allSliders = Slider::All()->where('slider_status', 1);

        $allProducts = Product::All()->where('product_status', 1);

        return view('client.home')->with('allSlidersFromTableByStatus', $allSliders)->with('allProductsFromTableByStatus', $allProducts);
    }


    public function shop()
    {
        $allCategories = Category::All();

        $allProducts = Product::All()->where('product_status', 1);

        return view('client.shop')->with('allCategoriesFromTable', $allCategories)->with('allProductsFromTableByStatus', $allProducts);
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
