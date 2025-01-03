<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Item::orderBy('name')->paginate(10);

        return view('item.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        if (!empty($item)) {

            $data = [
                'item' => $item
            ];
            return view('item.show', $data);

        } else {
            return redirect()->route('item.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'detail' => 'required',
            'colors' => ['required', 'array'],
            'colors.*' => ['required', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'],
            'manufacturer' => 'required|max:200',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : $item->status,
            'name' => $request->name,
            'colors' => json_encode($request->colors),
            'manufacturer' => $request->manufacturer,
            'detail' => $request->detail,
        ];

        $updated = Item::find($item->id)->update($data);

        return redirect()->route('item.index')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        Item::find($item->id)->delete();
        return redirect()->route('item.index')->with('success', 'Deleted successfully');
    }
}
