<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use SebastianBergmann\Type\VoidType;

class ProductController extends Controller


{
    public function allProducts(): View
    {
        $allProducts = Product::All();

        return view('admin.all_products')->with('allProductsFromTable', $allProducts);
    }

    public function addProduct()
    {   // ('category_name', 'id') ? 'category_name' - ? 'id' - ? Kudie?!
        $categoryNames = Category::All()->pluck('category_name', 'id');

        return view('admin.add_product')->with('allCategoryNamesFromTable', $categoryNames);
    }

    public function saveAddedProduct(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_category_id' => 'required',
            'product_image' => 'image|nullable|max:1999',
        ]);

        if ($request->hasFile('product_image')) {
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
    
            // Upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        }
        else {
            $fileNameToStore = 'no_image.png';
        }
        $newProduct = new Product();
        $newProduct->product_name = $request->input('product_name');
        $newProduct->product_price = $request->input('product_price');
        $newProduct->category_id = (int)$request->input('product_category_id');
        $newProduct->product_status = 1;
        $newProduct->product_image = $fileNameToStore;
        
        $newProduct->save();
    
        return back()->with('status', 'The Product "' . $request->input('product_name') . '" Added Successfully');
    }



    public function editProduct($id)
    {
        $productById = Product::find($id);

        $categoryNames = Category::All()->pluck('category_name', 'id');

        return view('admin.edit_product')->with('productFromTableById', $productById)->with('allCategoryNamesFromTable', $categoryNames);
    }



    public function updateEditedProduct(Request $request)
    {
        $this->validate(
            $request, 
            [
                'product_name' => 'required',
                'product_price' => 'required',
                'product_category' => 'required',
                'product_image' => 'image|nullable|max:1999',
            ],
        );

        $product = Product::find($request->input('id'));

        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->category_id = (int)$request->input('product_category');

        if ($request->hasFile('product_image')) {
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            // Upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

            if ($product->product_image != 'no_image.png') {
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



    public function productsByCategory($category_name): View
    {
        $allProducts = Product::join('categories', 'categories.id', '=', 'products.category_id')->where('categories.category_name', $category_name)->where('product_status', 1)->get();

        $allCategories = Category::All();

        return view('client.shop')->with('allProductsFromTableByStatusAndCategoryNameORallProductsFromTableByStatus', $allProducts)->with('allCategoriesFromTable', $allCategories);
    }





}