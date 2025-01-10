<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServicesReportExport implements FromCollection, WithHeadings
{
    protected $services;

    public function __construct($services)
    {
        $this->services = $services;
    }

    public function collection()
    {
        return $this->services->map(function ($service) {
            return [
                // 'ID' => $service->service_id,
                'Name' => $service->name,
                'Usage Count' => $service->total_usage_count,
                'Quantity Used' => $service->total_qty_used,
                'Amount' => $service->total_amount,
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
