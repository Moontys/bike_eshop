<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function allCategories()
    {
        $categories = Category::All();

        return view('admin.all_categories')->with('allCategories', $categories);
    }


    public function addCategory()
    {
        return view('admin.add_category');
    }


    public function saveAddedCategory(Request $request): RedirectResponse
    {
        $this->validate(
            $request,
        [
            'category_name' => 'required|unique:categories',
        ]);
    
        $newCategory = new Category();
        $newCategory->category_name = $request->input('category_name');
        $newCategory->save();
    
        return back()->with('status', 'The Category "' . $request->input('category_name') . '" Added Successfully');
    }


    public function editCategory(int $id): View
    {
        $categoryById = Category::find($id);

        return view('admin.edit_category')->with('categoryByUrlId', $categoryById);
    }


    public function updateEditedCategory(Request $request): RedirectResponse
    {
        $this->validate(
            $request,
        [
            'category_name' => 'required',
        ]);
        
        $updateCategoryByHiddenId = Category::find($request->input('id'));    // finds hidden "id" in the "edit_category.blade.php"

        $updateCategoryByHiddenId->category_name = $request->input('category_name');

        $updateCategoryByHiddenId->update();

        return redirect('/all-categories')->with('status', 'The Category "' . $request->input('category_name') . '" Updated Successfully');
    }


    public function deleteCategory(int $id): RedirectResponse
    {
        $productCountByUrlId = Product::where('category_id', $id)->count();

        if ($productCountByUrlId > 0) {
            return back()->with('error', 'Cannot Delete The Category Because There Are Products Assigned To It. Please Reassign These Products To A New Category Before Deleting');
        }

        $deleteCategoryByUrlId = Category::find($id);

        $categoryName = $deleteCategoryByUrlId->category_name;

        $deleteCategoryByUrlId->delete();

        return back()->with('status', 'The Category "' . $categoryName . '" Deleted Successfully');
    }
}
