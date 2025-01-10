<?php
namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsReportExport;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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

    public function create()
    {
        return view('product.create');
    }

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

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

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

    public function destroy(Product $product)
    {
        Product::find($product->id)->delete();
        return redirect()->route('product.index')->with('success', 'Deleted successfully');
    }

    public function report(Request $request)
    {
        if($request->from && $request->to) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();

            $products = Product::join('task_item_products', 'products.id', '=', 'task_item_products.product_id')
                ->select('products.name', 'products.sku')
                ->selectRaw('COUNT(task_item_products.id) as total_usage_count')
                ->selectRaw('SUM(task_item_products.qty) as total_qty_used')
                ->selectRaw('SUM(task_item_products.total) as total_amount')
                ->whereBetween('task_item_products.created_at', [$from, $to])
                // ->orWhereNull('task_item_products.id')
                ->groupBy('products.id', 'products.name', 'products.sku')
                ->orderBy('products.name')
                ->get();

            // Check if the 'report' parameter exists in the request
            if ($request->has('report')) {
                // Export to Excel
                return Excel::download(new ProductsReportExport($products), 'products_report.xlsx');
            }
            return view('product.report',compact('products', 'from', 'to'));
        }

        return view('product.report');
    }
}
