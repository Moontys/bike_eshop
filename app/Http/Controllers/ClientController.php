<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Cart;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;




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

        return view('client.shop')->with('allCategoriesFromTable', $allCategories)->with('allProductsFromTableByStatusAndCategoryNameORallProductsFromTableByStatus', $allProducts);
    }



    public function addToCart($id)
    {
        $product = Product::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        // dd(Session::get('cart'));
        return back();
    }


    public function updateQuantity(Request $request, $id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQuantity($id, $request->quantity);
        Session::put('cart', $cart);

        return back();
    }



    public function removeFromCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
       
        if(count($cart->items) > 0)
        {
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        return redirect('/cart');
    }


    public function cart()
    {
        if (!Session::has('cart'))
        {
            return view('client.cart');
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        return view('client.cart', ['products' => $cart->items]);
    }




    public function checkout()
    {
        if (!Session::has('client'))
        {
            return view('client.login');
        }
        return view('client.checkout');
    }


    
    public function signup()
    {
        return view('client.signup');
    }



    public function createAccount(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:clients',
            'password' => 'required|min:4']);

        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));
        
        $client->save();

        return back()->with('status', 'The Account Created Successfully');
    }




    public function login()
    {
        return view('client.login');
    }




    public function logOut()
    {
        Session::forget('client');

        return redirect('/shop');
    }




    public function accessAccount(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required']);

        $client = Client::where('email', $request->input('email'))->first();

            if ($client)
            {
                if (Hash::check($request->input('password'), $client->password))
                {
                    Session::put('client', $client);
                    return redirect(('/shop'));
                }
                else
                {
                    return back()->with('status', 'Incorect email or password');
                }
            }
            else
            {
                return back()->with('status', 'Something is wrong with this email');
            }

    }
}
