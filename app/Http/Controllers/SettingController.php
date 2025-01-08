<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::query()->get();

        $data = [
            'tax' => $settings->firstWhere('type', 'tax'),
            'term' => $settings->firstWhere('type', 'term'),
            'business_information' => $settings->firstWhere('type', 'business_information'),
            'email_settings' => $settings->firstWhere('type', 'email_settings'),
            'payments' => $settings->firstWhere('type', 'payments'),
        ];

        return view('setting.index', compact('data'));
    }

    public function store(Request $request)
    {
        if($request->type == 'tax') {
            $this->validate($request, [
                'name.*' => 'required',
                'percentage.*' => 'required',
                'status.*' => 'required',
            ]);
        }

        if($request->type == 'term') {
            $this->validate($request, [
                'title.*' => 'required',
                'link.*' => 'required',
                'is_required.*' => 'required',
            ]);
        }

        // Validation for Business Information settings
        if ($request->type == 'business_information') {
            $this->validate($request, [
                'company_name' => 'required|string|max:255',
                'company_email' => 'required|string|max:50',
                'company_website' => 'required|string|max:50',
                'company_phone' => 'required|string|max:15',
                'company_address' => 'required|string|max:255',
                'working_days' => 'required|array',
                'working_hours.start' => 'required|date_format:H:i',
                'working_hours.end' => 'required|date_format:H:i',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'favicon' => 'nullable|mimes:jpeg,png,jpg,gif,ico,webp|max:1024',
            ]);
        }

        // Validation for Email Settings
        if ($request->type == 'email_settings') {
            $this->validate($request, [
                'mail_mailer' => 'required|string|max:255',
                'mail_host' => 'required|string|max:255',
                'mail_port' => 'required|integer',
                'mail_username' => 'required|string|max:255',
                'mail_password' => 'required|string|max:255',
                'mail_encryption' => 'required|string|max:10',
                'mail_from_address' => 'required|email|max:255',
                'mail_from_name' => 'required|string|max:255',
            ]);
        }

        // Validation for Payments Settings
        if ($request->type == 'payments') {
            $this->validate($request, [
                'stripe_enabled' => 'nullable|boolean',
                'stripe_key' => 'nullable|string',
                'paypal_enabled' => 'nullable|boolean',
                'cash_payment_enabled' => 'nullable|boolean',
            ]);
        }

        $inputs = $request->except(['_token', 'type']);


         // If the request type is business_information or email_settings or payments, we just save the form data as is.
        // if ($request->type == 'business_information') {

        //     $logo = '';
        //     $favicon = '';
        //     if (!$request->hasFile('logo') || !$request->hasFile('favicon')) {
        //         $settings = Setting::where('type', 'business_information')->first();
        //         $businessDetails = json_decode($settings->data);
        //         $logo = $businessDetails->logo;
        //         $favicon = $businessDetails->favicon;
        //     }

        //     // For business information, we might also handle file uploads (logo and favicon)
        //     if ($request->hasFile('logo')) {
        //         $file = $request->logo;

        //         $filenameWithExt = $file->getClientOriginalName();
        //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //         $extension = $file->getClientOriginalExtension();
        //         $fileNameToStore = 'logo.' . $extension;
        //         $file->move(public_path('images/'), $fileNameToStore);
        //         $inputs['logo'] = $fileNameToStore;
        //     } else {
        //         $inputs['logo'] = $logo;
        //     }

        //     if ($request->hasFile('favicon')) {
        //         $file = $request->favicon;
        //         $filenameWithExt = $file->getClientOriginalName();
        //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //         $extension = $file->getClientOriginalExtension();
        //         $fileNameToStore = 'favicon.' . $extension;
        //         $file->move(public_path('images/'), $fileNameToStore);
        //         $inputs['favicon'] = $fileNameToStore;


        //         // $favicon = $request->file('favicon')->store('favicons', 'public');
        //         // $inputs['favicon'] = $favicon;
        //     } else {
        //         $inputs['favicon'] = $favicon;
        //     }

        //     $jsonData = json_encode($inputs);
        // }

        if ($request->type == 'business_information') {
            // Fetch current business details if no new files are uploaded
            $settings = Setting::where('type', 'business_information')->first();
            $businessDetails = json_decode($settings->data);
            $logo = $businessDetails->logo ?? '';
            $favicon = $businessDetails->favicon ?? '';

            // Handle file uploads for logo
            if ($request->hasFile('logo')) {
                $logo = $this->uploadFile($request->file('logo'), 'logo');
            }

            // Handle file uploads for favicon
            if ($request->hasFile('favicon')) {
                $favicon = $this->uploadFile($request->file('favicon'), 'favicon');
            }

            $inputs['logo'] = $logo;
            $inputs['favicon'] = $favicon;

            // Store the updated data
            $jsonData = json_encode($inputs);

        } elseif ($request->type == 'email_settings' || $request->type == 'payments') {
            $jsonData = json_encode($inputs);

        } else {
            // For tax or term, process the arrays
            $keys = array_keys($inputs);
            $data = [];
            $numItems = count($inputs[$keys[0]]);
            for ($i = 0; $i < $numItems; $i++) {
                $item = [];
                foreach ($keys as $key) {
                    $item[$key] = $inputs[$key][$i];
                }
                $data[] = $item;
            }
            $jsonData = json_encode($data);
        }


        // $keys = array_keys($inputs);
        // $data = [];
        // $numItems = count($inputs[$keys[0]]);
        // for ($i = 0; $i < $numItems; $i++) {
        //     $item = [];
        //     foreach ($keys as $key) {
        //         $item[$key] = $inputs[$key][$i];
        //     }
        //     $data[] = $item;
        // }

        // $jsonData = json_encode($data);

        Setting::updateOrCreate(
            ['type' => $request->type],
            ['data' => $jsonData]
        );

        return redirect()->route('setting.index')->with('success','Updated successfully');
    }

    private function uploadFile($file, $type)
    {
        $extension = $file->getClientOriginalExtension();
        $filenameToStore = $type . '.' . $extension;
        $file->move(public_path('images/'), $filenameToStore);
        return $filenameToStore;
    }
}
