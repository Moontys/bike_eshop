<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Models\Client;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Cart;
use App\Mail\SendMail;





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

        if (!Session::has('cart'))
        {
            return view('client.cart');
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




    public function allOrders()
    {
        $allOrders = Order::All();

        $allOrders->transform(function($orderFromTable, $key)
        {
            $orderFromTable->order_cart = unserialize($orderFromTable->order_cart);
            
            return $orderFromTable;
        });

        return view('admin.all_orders')->with('allOrdersFromTable', $allOrders);
    }

  


    public function postCheckout(Request $request)
    {
        try
        {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);

            $payerId = time();

            $newOrder = new Order();
            $newOrder->order_name =$request->input('order_name');
            $newOrder->order_address = $request->input('order_address');
            $newOrder->order_cart = serialize($cart);

            Session::out('newOrder', $newOrder);

            $checkoutData = $this->checkoutData();

            $provider = new ExpressCheckout();
    
            $response = $provider->setExpressCheckout($checkoutData);
    
            return redirect($response['paypal_link']);


        }
        catch(\Exception $e){
            return redirect('/checkout')->with('error', $e->getMessage());
        }
    }


    private function checkoutData(){

        $oldCart = Session::has('cart')? Session::get('cart'): null;

        $cart = new Cart($oldCart);

        $data['items'] = [];

        foreach($cart->items as $item ){
                $itemDetails=[
                'name' => $item['product_name'],
                'price' => $item['product_price'],
                'qty' => $item['qty']
                ];

            $data['items'][] = $itemDetails;       
        }

        $checkoutData = [
            'items' => $data['items'],
            'return_url' => url('/paiement-success'),
            'cancel_url' => url('/checkout'),
            'invoice_id' => uniqid(),
            'invoice_description' => "order description",
            'total' => Session::get('cart')->totalPrice
        ];

        return $checkoutData;
        }


    
    public function paymentSuccess(Request $request)
    {
        try
        {
            $token = $request->get('token');
            $payerIdFromPaypal = $request->get('PayerID');
            $checkoutData = $this->checkoutData();

            $provider = new ExpressCheckout();
            $response = $provider->getExpressCheckoutDetails($token);
            $response = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerIdFromPaypal);

            $payerId = $payerIdFromPaypal . '_' . time();
            
            Session::get('newOrder')->payer_id = $payerId;

            Session::get('newOrder')->save();

            $allOrders = Order::where('payer_id', $payerId)->get();

            $allOrders->transform(function($newOrder, $key)
            {
                $newOrder->order_cart = unserialize($newOrder->order_cart);
                
                return $newOrder;
            });

            $email = Session::get('client')->email;

            Mail::to($email)->send(new SendMail($allOrders));

            Session::forget('cart');

            return redirect('/cart')->with('status', 'Your Purchase Has Been Successfully Accomlished');
        }

        catch(\Exception $e)
        {
            return redirect('/checkout')->with('error', $e->getMessage());
        }

    } 
}
