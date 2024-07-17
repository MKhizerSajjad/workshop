<?php

namespace App\Http\Controllers;

use App\Models\PickupPoint;
use Illuminate\Http\Request;

class PickupPointController extends Controller
{
    public function index(Request $request)
    {
        $data = PickupPoint::orderBy('name')->paginate(10);

        return view('pickuppoint.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'colors' => ['required', 'array'],
            'colors.*' => ['required', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'],
            'manufacturer' => 'required|max:200',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'colors' => json_encode($request->colors),
            'manufacturer' => $request->manufacturer,
            'detail' => $request->detail,
        ];

        Item::create($data);

        return redirect()->route('item.index')->with('success','Record created successfully');
    }

    public function show(PickupPoint $pickupPoint)
    {
        //
    }

    public function edit(PickupPoint $pickupPoint)
    {
        //
    }

    public function update(Request $request, PickupPoint $pickupPoint)
    {
        //
    }

    public function destroy(PickupPoint $pickupPoint)
    {
        //
    }
}
