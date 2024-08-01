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

    public function store(Request $request)
    {
        if($request->type == 'tax') {
            $this->validate($request, [
                'name.*' => 'required',
                'percentage.*' => 'required',
                'status.*' => 'required',
            ]);
        }

        if($request->type == 'term') {
            $this->validate($request, [
                'title.*' => 'required',
                'link.*' => 'required',
                'is_required.*' => 'required',
            ]);
        }

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
}
