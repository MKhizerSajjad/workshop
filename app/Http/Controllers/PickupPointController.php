<?php

namespace App\Http\Controllers;

use App\Models\PickupPoint;
use Illuminate\Http\Request;

class PickupPointController extends Controller
{
    public function index(Request $request)
    {
        $data = PickupPoint::orderBy('name')->paginate(10);

        return view('pickup_point.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('pickup_point.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'name' => 'required|max:200',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'response_msg' => $request->response_msg,
        ];

        PickupPoint::create($data);

        return redirect()->route('pickup-point.index')->with('success','Record created successfully');
    }

    public function show(PickupPoint $pickupPoint)
    {
        //
    }

    public function edit(PickupPoint $pickupPoint)
    {
        return view('pickup_point.edit', compact('pickupPoint'));
    }

    public function update(Request $request, PickupPoint $pickupPoint)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'status' => 'required',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'response_msg' => $request->response_msg,
        ];

        PickupPoint::find($pickupPoint->id)->update($data);

        return redirect()->route('pickup-point.index')->with('success','Updated successfully');
    }

    public function destroy(PickupPoint $pickupPoint)
    {
        //
    }
}
