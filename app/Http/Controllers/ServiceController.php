<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ServicesReportExport;

use Carbon\Carbon;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $data = Service::with('service')->orderBy('name')->paginate(10);

        return view('service.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function list(Request $request)
    {
        $data = Service::with('service')->orderBy('name')->paginate(10);

        return view('service.list',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $tax = getTax();
        $services = Service::where('service_id', null)->select('id', 'name')->orderBy('name')->get();
        return view('service.create', compact('services', 'tax'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'name' => 'required|max:200',
            'price' => 'required',
            'add_tax' => 'required',
            'time' => 'required',
            'show_price' => 'required'
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'service_id' => $request->service_id ?? null,
            'sort_order' => $request->sort_order ?? null,
            'name' => $request->name,
            'price' => $request->price,
            'tax' => $request->tax,
            'time' => $request->time,
            'show_price' => $request->show_price,
            'add_tax' => $request->add_tax,
            // 'prioritized' => $request->prioritized ?? 2,
            'detail' => $request->detail,
        ];

        Service::create($data);

        return redirect()->route('service.index')->with('success','Record created successfully');
    }

    public function show(Service $service)
    {
        if (!empty($service)) {

            $data = [
                'service' => $service
            ];
            return view('service.show', $data);

        } else {
            return redirect()->route('service.index');
        }
    }

    public function edit(Service $service)
    {
        $tax = getTax();
        $services = Service::where([['service_id', null],['id', '!=', $service['id']]])->select('id', 'name')->orderBy('name')->get();
        return view('service.edit', compact('service', 'services', 'tax'));
    }

    public function update(Request $request, Service $service)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'price' => 'required',
            'add_tax' => 'required',
            'time' => 'required',
        ]);

        $data = [
            'status' => $request->status ?? $service->status,
            'service_id' => $request->service_id ?? null,
            'sort_order' => $request->sort_order ?? null,
            'name' => $request->name,
            'price' => $request->price,
            'tax' => $request->tax,
            'time' => $request->time,
            'show_price' => $request->show_price,
            'add_tax' => $request->add_tax,
            'detail' => $request->detail,
        ];

        $updated = Service::find($service->id)->update($data);

        return redirect()->route('service.index')->with('success','Updated successfully');
    }

    public function destroy(Service $service)
    {
        Service::find($service->id)->delete();
        return redirect()->route('service.index')->with('success', 'Deleted successfully');
    }

    public function report(Request $request)
    {
        if($request->from && $request->to) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();

            $services = Service::leftJoin('task_services', 'services.id', '=', 'task_services.service_id')
                    ->select('services.id as service_id', 'services.name')
                    ->selectRaw('COUNT(task_services.id) as total_usage_count')
                    ->selectRaw('SUM(task_services.qty) as total_qty_used')
                    ->selectRaw('SUM(task_services.unit_price * task_services.qty) as total_amount')
                    ->whereBetween('task_services.created_at', [$from, $to])
                    // ->orWhereNull('task_services.id')  // This includes services without task_services records
                    ->groupBy('services.id', 'services.name')  // Group by service id and name
                    ->orderBy('services.name')
                    ->get();

            // Check if the 'report' parameter exists in the request
            if ($request->has('report')) {
                // Export to Excel
                return Excel::download(new ServicesReportExport($services), 'services_report.xlsx');
            }
            return view('service.report',compact('services', 'from', 'to'));
        }

        return view('service.report');
    }
}
