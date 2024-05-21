<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;

class SuggestionController extends Controller
{

    public function index(Request $request)
    {
        $data = Suggestion::orderByDesc('created_at')->paginate(10);

        return view('suggestion.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'suggestion_for' => 'required',
            'suggestion_detail' => 'required',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'type' => $request->suggestion_for,
            'suggestion' => $request->suggestion_detail,
        ];

        $created = Suggestion::create($data);

        // if(isset($created)) {
        //     $this->sendEmial($data);
            return back()->with('success','Suggestion submitted successfully');
        // }
        // return redirect()->route('vpn.create')->with('Oops','We got error');
    }
}
