<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;




class ProductController extends Controller


{
    public function allProducts()
    {
        $products = Product::All();

        return view('admin.all_products')->with('allProductsFromTable', $products);
    }



    public function addProduct()
    {
        $categoryNames = Category::All()->pluck('category_name', 'category_name');

        return view('admin.add_product')->with('allCategoryNamesFromTable', $categoryNames);
    }
        

   
    public function saveAddedProduct(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_category' => 'required',
            'product_image' => 'image|nullable|max:1999'
        ]);
    
        if ($request->hasFile('product_image')) {

            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
    
            // Upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

        } else {

            $fileNameToStore = 'no_image.jpg';

        }
    
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');
        $product->product_image = $fileNameToStore;
    
        $product->save();
    
        return back()->with('status', 'The Product "' . $request->input('product_name') . '" Added Successfully');
    }



    public function editProduct($id)
    {
        $productFromTable = Product::find($id);

        $categoryNames = Category::All()->pluck('category_name', 'category_name');

        return view('admin.edit_product')->with('productFromTableById', $productFromTable)->with('allCategoryNamesFromTable', $categoryNames);
    }



    public function updateEditedProduct(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_category' => 'required',
            'product_image' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('product_image')) {

            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
    
            // Upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

        }

        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');
    
        $product->update();
    
        return back()->with('status', 'The Product "' . $request->input('product_name') . '" Updated Successfully');


    }

}