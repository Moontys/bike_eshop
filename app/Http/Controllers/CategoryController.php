<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;



class CategoryController extends Controller
{

    public function allCategories()
    {
        $categories = Category::All();

        return view('admin.all_categories')->with('allCategoriesFormTable', $categories);
    }



    public function addCategory()
    {
        return view('admin.add_category');
    }



    public function saveAddedCategory(Request $request)
    {
        $this->validate($request, ['category_name' => 'required|unique:categories']);
    
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();
    
        return back()->with('status', 'The Category "' . $request->input('category_name') . '" Added Successfully');
    }
    


    public function editCategory($id)
    {
        $category = Category::find($id);

        return view('admin.edit_category')->with('category', $category);
    }



    public function updateEditedCategory(Request $request)
    {
        $this->validate($request, ['category_name' => 'required']);


        $category = Category::find($request->input('id'));

        $category->category_name = $request->input('category_name');

        $category->update();

        return redirect('/all-categories')->with('status', 'The Category "' . $request->input('category_name') . '" Updated Successfully');
    }



    public function deleteCategory($id)
    {
        $category = Category::find($id);

        $categoryNameFromTableById = $category->category_name;

        $category->delete();

        return back()->with('status', 'The Category "' . $categoryNameFromTableById . '" Deleted Successfully');
    }
}
