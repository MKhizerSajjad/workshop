<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Notification::orderByDesc('created_at')->paginate(10);

        return view('notification.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:200',
            'detail' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : 1,
            'title' => $request->title,
            'detail' => $request->detail,
        ];

        Notification::create($data);

        return redirect()->route('notification.index')->with('success','Record created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        if (!empty($notification)) {

            $data = [
                'package' => $notification
            ];
            return view('notification.show', $data);

        } else {
            return redirect()->route('notification.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        return view('notification.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {

        $this->validate($request, [
            'title' => 'required|max:200',
            'detail' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : $notification->status,
            'title' => $request->title,
            'detail' => $request->detail,
        ];

        $updated = Notification::find($notification->id)->update($data);

        return redirect()->route('notification.index')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        Notification::find($notification->id)->delete();
        return redirect()->route('notification.index')->with('success', 'Deleted successfully');
    }
}
