<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AccessControl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccessControlController extends Controller
{
    public function index(Request $request)
    {
        $accessControls = AccessControl::with('user')->paginate(10);
        return view('access_control.index', compact('accessControls'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('access_control.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user' => 'required|exists:users,id',
            'assigned_ip' => 'nullable|ip|required_without:days,hours_start,hours_end',
            'days' => 'nullable|array|required_without:assigned_ip,hours_start,hours_end',
            'days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'hours_start' => 'nullable|date_format:H:i|required_without:assigned_ip,days',
            'hours_end' => 'nullable|date_format:H:i|after:hours_start|required_without:assigned_ip,days',
        ]);

        $data = [
            'user_id' => $request->user,
            'assigned_ip' => $request->assigned_ip,
            'days' => json_encode($request->days),
            'hours_start' => $request->hours_start,
            'hours_end' => $request->hours_end,
        ];

        AccessControl::create($data);

        return redirect()->route('access.index')->with('success', 'Access control created successfully!');
    }

    public function edit(AccessControl $accessControl, $id)
    {
        $access = AccessControl::whereId($id)->first();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('access_control.edit', compact('access', 'users'));
    }

    public function update(Request $request, AccessControl $accessControl, $id)
    {
        $this->validate($request, [
            'user' => 'required|exists:users,id',
            'assigned_ip' => 'nullable|ip|required_without:days,hours_start,hours_end',
            'days' => 'nullable|array|required_without:assigned_ip,hours_start,hours_end',
            'days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'hours_start' => 'nullable|required_without:assigned_ip,days',
            'hours_end' => 'nullable|after:hours_start|required_without:assigned_ip,days',
        ]);

        $data = [
            'user_id' => $request->user,
            'assigned_ip' => $request->assigned_ip,
            'days' => json_encode($request->days),
            'hours_start' => $request->hours_start,
            'hours_end' => $request->hours_end,
        ];

       AccessControl::find($id)->update($data);

        return redirect()->route('access.index')->with('success', 'Access control updated successfully!');
    }

    public function destroy($id)
    {
        AccessControl::whereId($id)->delete();
        return redirect()->route('access.index')->with('success', 'Access control deleted successfully!');
    }
}
