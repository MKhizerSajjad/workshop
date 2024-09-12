<?php

namespace App\Http\Controllers;

use App\Models\SerivceLocation;
use Illuminate\Http\Request;

class SerivceLocationController extends Controller
{

    public function index(Request $request)
    {
        $data = SerivceLocation::orderBy('title')->paginate(10);

        return view('service_location.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('service_location.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'status' => 'required',
            'fields.*.type' => 'required|string',
            'name' => 'required|array',
            'name.*' => 'required|string',
            'type' => 'required|array',
            'type.*' => 'required|string',
            'place_holder' => 'required|array',
            'place_holder.*' => 'required|string',
            'is_mandatory' => 'required|array',
            'is_mandatory.*' => 'required|string',
        ]);

        $generatedFields = [];

        for ($i = 0; $i < count($request->type); $i++) {
            $title = ucwords(str_replace('_', ' ', $request->name[$i]));
            $type = $request->type[$i];
            $isMandatory = $request->is_mandatory[$i];
            $place_holder = isset($request->place_holder[$i]) ? $request->place_holder[$i] : 'Enter ' . $title;

            $generatedFields[] = [
                'name' => $request->name[$i],
                'title' => $title,
                'type' => $type,
                'is_mandatory' => $isMandatory,
                'place_holder' => $place_holder,
            ];
        }

        $data = [
            'status' => $request->status ?? 1,
            'title' => $request->title,
            'detail' => $request->detail,
            'fields' => json_encode($generatedFields)
        ];

        SerivceLocation::create($data);

        return redirect()->route('service-location.index')->with('success','Record created successfully');
    }

    public function show(SerivceLocation $serivceLocation)
    {
        if (!empty($serivceLocation)) {

            $data = [
                'location' => $serivceLocation
            ];
            // return view('service_location.show', $data);

        } else {
            return redirect()->route('service-location.index');
        }
    }

    public function edit(SerivceLocation $serivceLocation, $id)
    {
        $serivceLocation = SerivceLocation::where('id', $id)->first();
        return view('service_location.edit', compact('serivceLocation'));
    }

    public function update(Request $request, SerivceLocation $serivceLocation, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'status' => 'required',
            'fields.*.type' => 'required|string',
            'name' => 'required|array',
            'name.*' => 'required|string',
            'type' => 'required|array',
            'type.*' => 'required|string',
            'place_holder' => 'required|array',
            'place_holder.*' => 'required|string',
            'is_mandatory' => 'required|array',
            'is_mandatory.*' => 'required|string',
        ]);

        $generatedFields = [];

        for ($i = 0; $i < count($request->type); $i++) {
            $title = ucwords(str_replace('_', ' ', $request->name[$i]));
            $type = $request->type[$i];
            $isMandatory = $request->is_mandatory[$i];
            $place_holder = isset($request->place_holder[$i]) ? $request->place_holder[$i] : 'Enter ' . $title;

            $generatedFields[] = [
                'name' => $request->name[$i],
                'title' => $title,
                'type' => $type,
                'is_mandatory' => $isMandatory,
                'place_holder' => $place_holder,
            ];
        }

        $data = [
            'status' => $request->status ?? $serivceLocation->status,
            'title' => $request->title,
            'detail' => $request->detail,
            'fields' => json_encode($generatedFields)
        ];

        SerivceLocation::find($id)->update($data);

        return redirect()->route('service-location.index')->with('success','Updated successfully');
    }

    public function destroy(SerivceLocation $serivceLocation)
    {
        SerivceLocation::find($serivceLocation->id)->delete();
        return redirect()->route('service-location.index')->with('success', 'Deleted successfully');
    }

    public function locationDetail($locationId)
    {
        $serviceLocation = SerivceLocation::findOrFail($locationId);
        return response()->json(['fields' => $serviceLocation->fields]);
    }
}
