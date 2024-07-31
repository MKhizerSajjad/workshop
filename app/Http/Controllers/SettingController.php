<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::query()->get();

        $data = [
            'tax' => $settings->firstWhere('type', 'tax'),
            'term' => $settings->firstWhere('type', 'term'),
        ];

        return view('setting.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $inputs = $request->except(['_token', 'type']);

        $keys = array_keys($inputs);
        $data = [];
        $numItems = count($inputs[$keys[0]]);
        for ($i = 0; $i < $numItems; $i++) {
            $item = [];
            foreach ($keys as $key) {
                $item[$key] = $inputs[$key][$i];
            }
            $data[] = $item;
        }

        $jsonData = json_encode($data);

        Setting::updateOrCreate(
            ['type' => $request->type],
            ['data' => $jsonData]
        );

        return redirect()->route('setting.index')->with('success','Updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
