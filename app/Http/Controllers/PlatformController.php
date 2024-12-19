<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index(Request $request)
    {
        $data = Platform::orderBy('name')->paginate(10);

        return view('platform.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $platforms = Platform::select('id', 'status', 'name', 'short')->orderBy('name')->get();
        return view('platform.create', compact('platforms'));
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
            'short' => $request->short ?? null,
            'icon' => $request->icon ?? null,
            'color' => $request->color ?? null,
            'detail' => $request->detail
        ];

        Platform::create($data);

        return redirect()->route('platform.index')->with('success','Record created successfully');
    }

    public function show(Platform $platform)
    {
        if (!empty($platform)) {

            $data = [
                'service' => $platform
            ];
            return view('platform.show', $data);

        } else {
            return redirect()->route('platform.index');
        }
    }

    public function edit(Platform $platform)
    {
        $platforms = Platform::select('id', 'status', 'name', 'short')->orderBy('name')->get();
        return view('platform.edit', compact('platform', 'platforms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Platform $platform)
    {
        $this->validate($request, [
            'status' => 'required',
            'name' => 'required|max:200',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'short' => $request->short ?? null,
            'icon' => $request->icon ?? null,
            'color' => $request->color ?? null,
            'detail' => $request->detail
        ];

        Platform::find($platform->id)->update($data);

        return redirect()->route('platform.index')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platform $platform)
    {
        Platform::find($platform->id)->delete();
        return redirect()->route('platform.index')->with('success', 'Deleted successfully');
    }
}
