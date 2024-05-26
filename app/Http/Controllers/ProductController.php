<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function add()
    {
        $categories = Category::get();
        return view('product.add', ['categories' => $categories]);
    }
    public function product()
    {
        Session::forget('success');
        return view('product');
    }
    public function new(Request $request)
    {
        $validatedData = $request->validate([
            'manufacturer' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
        ]);
        if ($validatedData) {
            Product::create($validatedData);
            Session::flash('success', 'Product created successfully');
            $products = Product::with('category')->get();
            return redirect()->route('product.list');
        } else {
            Session::flash('error', 'Something went wrong');
            return redirect()->route('product.list');
        }
    }
    public function list(Request $request)
    {
        Session::forget('success');
        Session::forget('error');
        $products = Product::with('category')->get();
        
       return view('product.list', ['products' => $products]);
    }
    public function delete($productId)
    {
        Product::where('id', $productId)->delete();
        $products = Product::with('category')->get();
        Session::flash('success', 'Product delete');
        return view('product.list', ['products' => $products]);
    }
    public function edit($productId)
    {
        $product = Product::where('id', $productId)->first();
        $categories = Category::get();
        return view('product.edit', ['product' => $product, 'categories' => $categories]);
    }
    public function update(Request $request, $productId)
    {
        // $product = Product::find($productId);
        // $product->update(['name' => $request->name]);
        // $products = Product::get();
        // Session::flash('success', 'Category Update');
        // return view('product.list', ['products' => $products]);
    }
}
