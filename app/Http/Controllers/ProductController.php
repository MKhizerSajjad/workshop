<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $data = Product::orderBy('name')->where('name', 'LIKE', '%'.$request->product.'%')->paginate($limit);

        return view('product.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function list(Request $request)
    {
        $data = Product::orderBy('name')->where('name', 'LIKE', '%'.$request->product.'%')->paginate(10);

        return view('product.list',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'price' => 'required',
            'tax' => 'required',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'price' => $request->price,
            'tax' => $request->tax,
            'detail' => $request->detail,
        ];

        Product::create($data);

        return redirect()->route('product.index')->with('success','Record created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if (!empty($product)) {

            $data = [
                'product' => $product
            ];
            return view('product.show', $data);

        } else {
            return redirect()->route('product.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            // 'name' => 'required|max:200',
            'price' => 'required',
            'stock' => 'required',
            // 'tax' => 'required',
        ]);

        $data = [
            // 'status' => $request->status ?? 1,
            // 'name' => $request->name,
            'price' => $request->price,
            'stock_quantity' => $request->stock,
            // 'tax' => $request->tax,
            // 'detail' => $request->detail,
        ];

        $updated = Product::find($product->id)->update($data);

        return redirect()->route('product.index')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::find($product->id)->delete();
        return redirect()->route('product.index')->with('success', 'Deleted successfully');
    }
}
