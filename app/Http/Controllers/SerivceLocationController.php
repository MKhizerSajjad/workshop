<?php

namespace App\Http\Controllers;

use App\Models\SerivceLocation;
use Illuminate\Http\Request;

class SerivceLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SerivceLocation $serivceLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SerivceLocation $serivceLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SerivceLocation $serivceLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SerivceLocation $serivceLocation)
    {
        //
    }

    public function locationDetail($locationId)
    {
        $serviceLocation = SerivceLocation::findOrFail($locationId);
        return response()->json(['fields' => $serviceLocation->fields]);
    }
}
