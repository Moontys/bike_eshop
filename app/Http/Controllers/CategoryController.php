<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;



class CategoryController extends Controller
{

    public function allCategories()
    {
        $categories = Category::All();

        return view('admin.all_categories')->with('categories', $categories);
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
    
        return back()->with('status', 'Category ' . $request->input('category_name') . ' Added Successfully');
    }
    




}
