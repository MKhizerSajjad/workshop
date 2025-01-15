<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Customer;
use App\Models\Newsletter;
use App\Notifications\NewsletterNotificaion;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $data = Newsletter::where('status', '1')->orderByDesc('created_at')->paginate(10);

        return view('newsletter.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    public function create()
    {
        return view('newsletter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $newsletter = Newsletter::create($request->only('title', 'content'));

        return redirect()->route('newsletter.index')->with('success', 'Newsletter created successfully!');
    }

    public function send($id)
    {
        $customers = Customer::where('receive_newsletter', 1)->get();

        $newsletter = Newsletter::find($id);

        foreach ($customers as $customer) {
            $customerFullname = $customer->first_name . ' ' . $customer->last_name;
            $company = Setting::where('type', 'business_information')->first();
            $company = json_decode($company->data);
            $data = [
                'customer_name' => $customerFullname,
                'subject' => $newsletter->title,
                'content' => $newsletter->content,
                'company_email' => $company->company_email,
                'company_website' => $company->company_website,
            ];

            $customer->notify(new NewsletterNotificaion($data));
        }

        return redirect()->route('newsletter.index')->with('success', 'Newsletter sent successfully!');
    }

    public function edit(Newsletter $newsletter)
    {
        return view('newsletter.edit', compact('newsletter'));
    }

    public function update(Request $request, Newsletter $newsletter)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : $newsletter->status,
            'title' => $request->title,
            'content' => $request->content,
        ];

        $updated = Newsletter::find($newsletter->id)->update($data);

        return redirect()->route('newsletter.index')->with('success', 'Newsletter updated successfully!');
    }

}
