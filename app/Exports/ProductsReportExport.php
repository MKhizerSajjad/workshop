<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsReportExport implements FromCollection, WithHeadings
{
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function collection()
    {
        return $this->products->map(function ($product) {
            return [
                // 'ID' => $product->product_id,
                'Name' => $product->name,
                'Usage Count' => $product->total_usage_count,
                'Quantity Used' => $product->total_qty_used,
                'Amount' => $product->total_amount,
            ];
        });
    }

    public function headings(): array
    {
        return [
            // 'ID',
            'Name',
            'Usage Count',
            'Quantity Used',
            'Amount',
        ];
    }
}
