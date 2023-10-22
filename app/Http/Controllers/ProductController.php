<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller


{
    public function allProducts()
    {
        $products = Product::All();
        // $products = Product::All()->where('product_status', 1);
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

            $fileNameToStore = 'no_image.png';

        }
    
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');
        $product->product_image = $fileNameToStore;
        $product->product_status = 1;
    
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

        $product = Product::find($request->input('id'));

        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');

        if ($request->hasFile('product_image'))
            {
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

            if ($product->product_image != 'no_image.png')
            {
                Storage::delete('public/product_images/' . $product->product_image);
            }

            $product->product_image = $fileNameToStore;
        }
        $product->update();

        return redirect('/all-products')->with('status', 'The Product "' . $request->input('product_name') . '" Updated Successfully');
    }



    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if ($product->product_image != 'no_image.png')
        {
            Storage::delete('public/product_images/' . $product->product_image);
        }

        $product->delete();

        return back()->with('status', 'The Product "' . $product->product_name . '" Deleted Successfully');
    }


    
    public function activateProduct($id)
    {
        $product = Product::find($id);

        $product->product_status = 1;

        $product->update();

        return back()->with('status', 'The Product "' . $product->product_name . '" Activated Successfully');
    }



    public function unactivateProduct($id)
    {
        $product = Product::find($id);

        $product->product_status = 0;

        $product->update();

        return back()->with('status', 'The Product "' . $product->product_name . '" Unactivated Successfully');
    }
}