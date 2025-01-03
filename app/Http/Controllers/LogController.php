<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $data = Log::orderByDesc('created_at')->paginate(10);

        return view('log.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
}
