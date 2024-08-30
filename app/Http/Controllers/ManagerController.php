<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index(Request $request)
    {
        $data = User::where('user_type', 2)->orderBy('first_name')->paginate(10);

        return view('manager.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $user = Auth::user()->user_type;
        return view('manager.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:245', 'unique:users'],
            'phone' => ['required', 'string', 'max:15', 'unique:users', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'user_type' => $request->user_type ?? 2,
            'picture' => '',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address ?? null,
            'password' => Hash::make($request->password),
        ];

        User::create($data);

        return redirect()->route('manager.index')->with('success','Record created successfully');
    }

    public function show(User $user)
    {
        if (!empty($user)) {

            $data = [
                'user' => $user
            ];
            return view('manager.show', $data);

        } else {
            return redirect()->route('manager.index');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('manager.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:150'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'user_type' => $request->user_type ?? 2,
            'picture' => '',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address ?? null,
        ];

        if ($request->has('password') && $request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::find($id)->update($data);
        return redirect()->route('manager.index')->with('success','Updated successfully');
    }

    public function destroy(User $user)
    {
        User::find($user->id)->delete();
        return redirect()->route('manager.index')->with('success', 'Deleted successfully');
    }
}
