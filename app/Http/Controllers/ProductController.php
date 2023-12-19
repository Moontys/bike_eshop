<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private const PRODUCTS_NUMBER_PER_PAGE = 8;
    
    public function allProducts(): View
    {
        $products = Product::All();

        return view('admin.all_products')
            ->with('allProducts', $products);
    }


    public function addProduct(): View
    {
        $categoryNames = Category::All()->pluck('category_name', 'id');

        $discountNames = Discount::All()->pluck('discount_name', 'id');

        return view('admin.add_product')
            ->with('allCategoryNames', $categoryNames)
            ->with('allDiscountNames', $discountNames);
    }


    public function saveAddedProduct(Request $request): RedirectResponse
    {
        $this->validate(
            $request, 
            [
            'product_name' => 'required',
            'product_price' => 'required',
            // 'products_category_id_categories_id' => 'required',
            'product_description' => 'required|max:5000',
            // 'product_image' => 'image|nullable|max:1999',
            ]);

        if ($request->hasFile('product_image')) {
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
    
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'no_image.png';
        }

        $newProduct = new Product();
        $newProduct->product_name = $request->input('product_name');
        $newProduct->product_price = $request->input('product_price');
        $newProduct->discount_id = $request->input('products_discount_id_discounts_id');
        $newProduct->category_id = (int)$request->input('products_category_id_categories_id');
        $newProduct->product_status = 1;
        $newProduct->product_description = $request->input('product_description');
        $newProduct->product_image = $fileNameToStore;
        
        $newProduct->save();
    
        return back()
            ->with('status', 'The Product "' . $request->input('product_name') . '" Added Successfully');
    }



    public function editProduct(int $id): View
    {
        $productById = Product::find($id);

        $categoryNames = Category::All()->pluck('category_name', 'id');

        $discountNames = Discount::All()->pluck('discount_name', 'id');

        return view('admin.edit_product')
            ->with('productByUrlId', $productById)
            ->with('allCategoryNames', $categoryNames)
            ->with('allDiscountNames', $discountNames->all());
    }



    public function updateEditedProduct(Request $request): RedirectResponse
    {
        $this->validate(
            $request, 
            [
                'product_name' => 'required',
                'product_price' => 'required',
                'products_category_id_categories_id' => 'required',
                'product_description' => 'required|max:5000',
                'product_image' => 'image|nullable|max:1999',
            ],
        );

        $updateProductByHiddenId = Product::find($request->input('id'));    // finds hidden "id" in the "edit_product.blade.php"

        $updateProductByHiddenId->product_name = $request->input('product_name');
        $updateProductByHiddenId->product_price = $request->input('product_price');
        
        if ($request->input('products_discount_id_discounts_id') !== null) {
            $updateProductByHiddenId->discount_id = (int)$request->input('products_discount_id_discounts_id');
        } else {
            $updateProductByHiddenId->discount_id = $request->input('products_discount_id_discounts_id');
        }

        $updateProductByHiddenId->category_id = (int)$request->input('products_category_id_categories_id');
        $updateProductByHiddenId->product_description = $request->input('product_description');

        if ($request->hasFile('product_image')) {
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

            if ($updateProductByHiddenId->product_image != 'no_image.png') {
                Storage::delete('public/product_images/' . $updateProductByHiddenId->product_image);
            }

            $updateProductByHiddenId->product_image = $fileNameToStore;
        }

        $updateProductByHiddenId->update();

        return redirect('/all-products')
            ->with('status', 'The Product "' . $request->input('product_name') . '" Updated Successfully');
    }



    public function deleteProduct(int $id): RedirectResponse
    {
        $deleteProductByUrlId = Product::find($id);

        if ($deleteProductByUrlId->product_image != 'no_image.png')
        {
            Storage::delete('public/product_images/' . $deleteProductByUrlId->product_image);
        }

        $deleteProductByUrlId->delete();

        return back()
            ->with('status', 'The Product "' . $deleteProductByUrlId->product_name . '" Deleted Successfully');
    }


    
    public function activateProduct(int $id): RedirectResponse
    {
        $activateProductByUrlId = Product::find($id);

        $activateProductByUrlId->product_status = 1;

        $activateProductByUrlId->update();

        return back()
            ->with('status', 'The Product "' . $activateProductByUrlId->product_name . '" Activated Successfully');
    }



    public function unactivateProduct(int $id): RedirectResponse
    {
        $unactivateProductByUrlId = Product::find($id);

        $unactivateProductByUrlId->product_status = 0;

        $unactivateProductByUrlId->update();

        return back()->with('status', 'The Product "' . $unactivateProductByUrlId->product_name . '" Unactivated Successfully');
    }


    public function productsByCategory($category_name): View
    {
        $productsByCategoryAndStatus = Product::select('products.*')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->where('categories.category_name', $category_name)
            ->where('product_status', 1)
            ->paginate(self::PRODUCTS_NUMBER_PER_PAGE);

        $categories = Category::All();

        $slidersByStatus = Slider::All()
            ->where('slider_status', 1);

        return view('client.shop')
            ->with('allProductsByStatusOrByCategoryAndStatus', $productsByCategoryAndStatus)
            ->with('allSlidersByStatus', $slidersByStatus)
            ->with('allCategories', $categories);
    }


    public function shop(): View
    {
        $categories = Category::All();

        $productsByStatus = Product::where('product_status', 1)
            ->paginate(self::PRODUCTS_NUMBER_PER_PAGE);

        $slidersByStatus = Slider::All()
            ->where('slider_status', 1);

        return view('client.shop')
            ->with('allCategories', $categories)
            ->with('allProductsByStatusOrByCategoryAndStatus', $productsByStatus)
            ->with('allSlidersByStatus', $slidersByStatus);
    }

    
    public function displayProduct(int $id): View
    {
        $productById = Product::find($id);

        return view('client.display_product')
            ->with('productByUrlId', $productById);
    }
}