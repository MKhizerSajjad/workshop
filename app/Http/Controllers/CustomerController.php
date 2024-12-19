<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $data = Customer::orderBy('first_name')->paginate(10);

        return view('customer.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return redirect()->route('customer.index')->with('success','Not Accessible');
        // return view('customer.create');
    }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:150'],
    //         'email' => ['required', 'string', 'email', 'max:245', 'unique:users'],
    //         'phone' => ['required', 'string', 'max:15', 'unique:users', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     $data = [
    //         'status' => $request->status ?? 1,
    //         'user_type' => 4,
    //         'picture' => '',
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'address' => $request->address ?? null,
    //         'password' => Hash::make($request->password),
    //     ];

    //     User::create($data);

    //     return redirect()->route('customer.index')->with('success','Record created successfully');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        if (!empty($user)) {

            $data = [
                'user' => $user
            ];
            return view('customer.show', $data);

        } else {
            return redirect()->route('customer.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Customer::findOrFail($id);
        return view('customer.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $action = $request->input('action');

        if ($action == 'update-comment') {
            $this->validate($request, [
                'status' => ['required', 'integer'],
                'status_detail' => ['required', 'string', 'max:255'],
            ]);

            $data = [
                'status' => $request->status,
                'status_detail' => $request->status_detail,
            ];
        } else {
            $this->validate($request, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:150'],
                'email' => ['required', 'string', 'email', 'max:70', 'unique:customers,email,' . $id],
                'phone' => ['required', 'string', 'regex:/^\+?[0-9]\d{1,14}$/', 'max:15', 'unique:customers,phone,' . $id],
                'company' => ['required', 'string', 'max:50'],
                'city' => ['required', 'string', 'max:50'],
                'address' => ['required', 'string', 'max:255'],
            ]);

            $data = [
                'status' => $request->status ?? 1,
                'first_name' => $request->first_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company,
                'city' => $request->city,
                'platform_id' => $request->platform_id ?? null,
                'address' => $request->address ?? null,
            ];
        }

        if ($request->has('password') && $request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        Customer::find($id)->update($data);
        return redirect()->route('customer.edit', $id)->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::find($user->id)->delete();
        return redirect()->route('customer.index')->with('success', 'Deleted successfully');
    }
}
