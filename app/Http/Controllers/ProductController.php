<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//use Session;
use Illuminate\Support\Facades\Session;




class ProductController extends Controller


{
    public function displayProduct($id)
    {
        $product = Bicycle::find($id);

        return view('pages.product')->with('product', $product);
    }



    public function addProduct()
    {
        return view('pages.add_product');
    }



    public function saveAddedProduct(Request $request)
    {
        $product = new Bicycle();
        $product->bicycle_brand = $request->input('product_brand');
        $product->bicycle_price = $request->input('product_price');
        
        $product->bicycle_image = $request->input('product_image');
        $product->bicycle_description = $request->input('product_description');
        $product->save();


        $fileNameWithExt = $request->file('product_image')->getClientOriginalName();

        // print('Original Name of the Image with Extension - ' . $fileNameWithExt);

        // echo '<pre></pre>';


        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        // print('Original Name of the Image without Extention - ' . $fileName);

        // echo '<pre></pre>';


        $ext = $request->file('product_image')->getClientOriginalExtension();

        // print('Extention of the Image - ' . $ext);

        // echo '<pre></pre>';


        $fileNameToStore = $fileName . '_' . time() . '.' . $ext;

        // echo '<pre></pre>';

        // print('File Name for Storing - ' . $fileNameToStore);

        

        Session::put('success', 'The Product Has Been Added Successfully!');

        return redirect('/admin-like-for-now/add-product');
    }







    public function editProduct($id)
    {   
        $product = Bicycle::find($id);

        return view('pages.edit_product')->with('bicycleData', $product); // 'product' - name used to refer to the bicycle's data when sending it to the 'edit_product' view
    }




    public function updateEditedProduct(Request $request)
    {
        $product = Bicycle::find($request->input('id')); // Retrieves the product's ID sent via a hidden field in the form: {{Form::hidden('id', $product->id)}}
        $product->bicycle_brand = $request->input('product_brand');
        $product->bicycle_price = $request->input('product_price');
        $product->bicycle_description = $request->input('product_description');
        $product->update();

        Session::put('success', $request->input('product_brand') .' Has Been Updated Successfully!');

        return redirect('/admin-like-for-now/edit-product/' . $request->input('id'));
    }







    

    public function deleteProduct($id)
    {
        $product = Bicycle::find($id);
        $product->delete();

        Session::put('success', 'The Product Has Been Deleted Successfully!');

        return redirect('/admin-like-for-now');
    }

    
}