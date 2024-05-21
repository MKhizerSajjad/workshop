<?php

namespace App\Http\Controllers;

// use Mail;
use App\Models\Vpn;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;

class VpnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $vpnApplied = Vpn::where('user_id', $userId)->get();

        if(count($vpnApplied) > 0) {
            return view('vpn.index');
        } else {
            return view('vpn.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();
        $vpnApplied = Vpn::where('user_id', $userId)->get();

        if(count($vpnApplied) > 0) {
            return view('vpn.index');
        } else {
            return view('vpn.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_no' => 'nullable|unique:vpns',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:vpns',
            'phone' => 'required|unique:vpns',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'id_no' => $request->id_no,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        $created = Vpn::create($data);

        // if(isset($created)) {
        //     $this->sendEmial($data);
            return redirect()->route('vpn.create')->with('success','VPN requested successfully');
        // }
        // return redirect()->route('vpn.create')->with('Oops','We got error');

    }

    /**
     * Display the specified resource.
     */
    public function show(Vpn $vpn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vpn $vpn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vpn $vpn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vpn $vpn)
    {
        //
    }

    private function sendEmial($data) {

        $content = [
            'subject' => 'Test',
            'body' => '|Test Body'
        ];
        Mail::to('recipient@example.com')->send(new SendMail($content));

        $content = [
            'subject' => 'VPN Request',
            'body' => 'News VPN request, user details are: <br>' . json_encode($data)
        ];

        Mail::to('mkhizersajjad@gmail.com')->send(new SendMail($content));
    }
}
