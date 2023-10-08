<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//use Session;
use Illuminate\Support\Facades\Session;




class ProductController extends Controller


{

    public function displayProduct($id)    {

        $product = Bicycle::find($id);

        return view('pages.product')->with('product', $product);
    }




    public function addProduct()    {

        return view('pages.add_product');
    }




    public function saveAddedProduct(Request $request)   {

        $product = new Bicycle();
        $product->bicycle_brand = $request->input('product_brand');
        $product->bicycle_price = $request->input('product_price');
        $product->bicycle_description = $request->input('product_description');
        $product->save();

        Session::put('success', 'The Product Has Been Added Successfully!');

        return redirect('/admin-like-for-now/add-product');
    }




    public function editProduct($id)    {

        $product = Bicycle::find($id);

        return view('pages.edit_product')->with('product', $product);
    }


    

    public function updateEditedProduct(Request $request)   { // Alieliaus klausti del id.. Id hidden: "edit_product.blade.php" 

        $product = Bicycle::find($request->input('id'));
        $product->bicycle_brand = $request->input('product_brand');
        $product->bicycle_price = $request->input('product_price');
        $product->bicycle_description = $request->input('product_description');
        $product->update();

        Session::put('success', 'The Product Has Been Updated Successfully!');

        return redirect('/admin-like-for-now/edit-product/' . $request->input('id'));
    }



}