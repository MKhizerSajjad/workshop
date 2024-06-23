<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data = User::whereIn('user_type', [2,3])->orderBy('first_name')->paginate(10);

        return view('employee.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:245', 'unique:users'],
            'phone' => ['required', 'string', 'max:15', 'unique:users', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'user_type' => $request->user_type ?? 3,
            'picture' => '',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address ?? null,
            'password' => Hash::make($request->password),
        ];

        User::create($data);

        return redirect()->route('employee.index')->with('success','Record created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (!empty($user)) {

            $data = [
                'user' => $user
            ];
            return view('employee.show', $data);

        } else {
            return redirect()->route('employee.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('employee.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:150'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'user_type' => $request->user_type ?? 3,
            'picture' => '',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address ?? null,
        ];

        if ($request->has('password') && $request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::find($id)->update($data);
        return redirect()->route('employee.index')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::find($user->id)->delete();
        return redirect()->route('employee.index')->with('success', 'Deleted successfully');
    }
}
