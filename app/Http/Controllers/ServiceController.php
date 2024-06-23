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
        $data = Service::orderBy('name')->paginate(10);

        return view('service.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service.create');
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
        return view('service.edit', compact('service'));
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
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'price' => $request->price,
            'tax' => $request->tax,
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
