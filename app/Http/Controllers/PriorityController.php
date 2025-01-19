<?php

namespace App\Http\Controllers;

use App\Models\priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function index(Request $request)
    {
        $data = Priority::orderBy('price')->paginate(10);

        return view('priority.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('priority.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'price' => 'required',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'price' => $request->price,
            'detail' => $request->detail,
        ];

        Priority::create($data);

        return redirect()->back()->with('success','Record created successfully');
    }

    public function show(priority $priority)
    {
        if (!empty($priority)) {

            $data = [
                'priority' => $priority
            ];
            return view('priority.show', $data);

        } else {
            return redirect()->route('priority.index');
        }
    }

    public function edit(priority $priority)
    {
        return view('priority.edit', compact('priority'));
    }

    public function update(Request $request, priority $priority)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'price' => 'required',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'price' => $request->price,
            'detail' => $request->detail,
        ];

        $updated = Priority::find($priority->id)->update($data);

        return redirect()->back()->with('success','Updated successfully');
    }

    public function destroy(priority $priority)
    {
        Priority::find($priority->id)->delete();
        return redirect()->route('priority.index')->with('success', 'Deleted successfully');
    }
}
