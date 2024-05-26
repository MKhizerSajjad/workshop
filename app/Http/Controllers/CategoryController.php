<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function category()
    {
        return view('category.add');
    }
    public function product()
    {
        Session::forget('success');
        return view('product');
    }
    public function new(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if ($validatedData) {
            Category::create($validatedData);
            Session::flash('success', 'Category created successfully');
            $categories = Category::get();
            return view('category.list', ['categories' => $categories]);
        } else {
            Session::flash('error', 'Something went wrong');
            return redirect()->route('category.add');
        }
    }
    public function list(Request $request)
    {
        Session::forget('success');
        Session::forget('error');
        $categories = Category::get();
        
       return view('category.list', ['categories' => $categories]);
    }
    public function delete($categoryId)
    {
        Category::where('id', $categoryId)->delete();
        $categories = Category::get();
        Session::flash('success', 'Category delete');
        return view('category.list', ['categories' => $categories]);
    }
    public function edit($categoryId)
    {
        $category = Category::where('id', $categoryId)->first();
        return view('category.edit', compact('category'));
    }
    public function update(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);
        $category->update(['name' => $request->name]);
        $categories = Category::get();
        Session::flash('success', 'Category Update');
        return view('category.list', ['categories' => $categories]);
    }
}
