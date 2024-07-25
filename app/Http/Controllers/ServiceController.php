<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('service_id', null)->select('id', 'name')->orderBy('name')->get();
        return view('service.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'name' => 'required|max:200',
            'price' => 'required',
            'tax' => 'required',
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
            // 'prioritized' => $request->prioritized ?? 2,
            'detail' => $request->detail,
        ];

        Service::create($data);

        return redirect()->route('service.index')->with('success','Record created successfully');
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $services = Service::where([['service_id', null],['id', '!=', $service['id']]])->select('id', 'name')->orderBy('name')->get();
        return view('service.edit', compact('service', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'price' => 'required',
            'tax' => 'required',
            'time' => 'required',
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
            'detail' => $request->detail,
        ];

        $updated = Service::find($service->id)->update($data);

        return redirect()->route('service.index')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        Service::find($service->id)->delete();
        return redirect()->route('service.index')->with('success', 'Deleted successfully');
    }
}
