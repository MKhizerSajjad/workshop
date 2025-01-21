<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Notifications\TestNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    use Notifiable;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::query()->get();

        $data = [
            'tax' => $settings->firstWhere('type', 'tax'),
            'term' => $settings->firstWhere('type', 'term'),
            'general' => $settings->firstWhere('type', 'general'),
            'business_information' => $settings->firstWhere('type', 'business_information'),
            'email' => $settings->firstWhere('type', 'email'),
            'payments' => $settings->firstWhere('type', 'payments'),
            'bank_accounts' => $settings->firstWhere('type', 'bank_accounts'),
            'woocommerece' => $settings->firstWhere('type', 'woocommerece'),
            'task_additional_price' => $settings->firstWhere('type', 'task_additional_price'),
            'language' => $settings->firstWhere('type', 'language'),
        ];

        return view('setting.index', compact('data'));
    }

    public function payment()
    {
        return view('setting.payment');
    }

    public function email()
    {
        return view('setting.email');
    }

    public function business()
    {
        return view('setting.business');
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

        if ($request->type == 'general') {
            $this->validate($request, [
                'website_name' => 'nullable|string|max:25',
                'report_company' => 'nullable|string|max:25',
                'report_email' => 'nullable|string|max:50',
                'currency' => 'required|string|max:10',
                'currency_symbol' => 'required|string|max:1',
                'case_prefix' => 'required|string|max:5'
            ]);
        }

        if($request->type == 'woocommerece') {
            $this->validate($request, [
                'base_url' => 'required',
                'consumer_key' => 'required',
                'consumer_secret' => 'required',
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
                'main_color' => 'nullable|regex:/^#([A-Fa-f0-9]{3}){1,2}$/',
                'report_invoice_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'favicon' => 'nullable|mimes:jpeg,png,jpg,gif,ico,webp|max:1024',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ]);
        }

        // Validation for Email Settings
        if ($request->type == 'email') {
            $this->validate($request, [
                'report_email' => 'required|string|max:255',
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

        if($request->type == 'task_additional_price') {
            $this->validate($request, [
                'amount' => 'required',
            ]);
        }

        if($request->type == 'tax') {
            $this->validate($request, [
                'account_name.*' => 'required',
                'bank_name.*' => 'required',
                'swift_code.*' => 'required',
                'iban.*' => 'required',
                'account_number.*' => 'required',
            ]);
        }

        if($request->type == 'language') {
            $this->validate($request, [
                'language' => 'required',
            ]);
        }

        if($request->type == 'case') {
            $this->validate($request, [
                'case_prefix' => 'required',
            ]);
        }

        if($request->type == 'currencies') {
            $this->validate($request, [
                'name.*' => 'required',
                'symbol.*' => 'required'
            ]);
        }

        $inputs = $request->except(['_token', 'type']);

        if ($request->type == 'business_information') {
            // Fetch current business details if no new files are uploaded
            $settings = Setting::where('type', 'business_information')->first();
            $businessDetails = json_decode($settings->data);
            $logo = $businessDetails->logo ?? '';
            $favicon = $businessDetails->favicon ?? '';

            // Handle file uploads for logo
            if ($request->hasFile('report_invoice_logo')) {
                $reportInvoiceLogo = $this->uploadFile($request->file('report_invoice_logo'), 'report_invoice_logo');
            }

            // Handle file uploads for favicon
            if ($request->hasFile('favicon')) {
                $favicon = $this->uploadFile($request->file('favicon'), 'favicon');
            }

            // Handle file uploads for logo
            if ($request->hasFile('logo')) {
                $logo = $this->uploadFile($request->file('logo'), 'logo');
            }

            $inputs['report_invoice_logo'] = $reportInvoiceLogo;
            $inputs['favicon'] = $favicon;
            $inputs['logo'] = $logo;

            // Store the updated data
            $jsonData = json_encode($inputs);

        } elseif ($request->type == 'payments') {

            $data = [
                [
                    // 'paypal' => [
                    //     'api_key' => $inputs['api_key'],
                    //     'enabled' => $inputs['enable'] == true
                    // ],
                    'stripe' => [
                        'api_key' => $inputs['api_key'],
                        'enabled' => $inputs['enable'] == true
                    ],
                    'cash_payment_enabled' => true
                ]
            ];
            $jsonData = json_encode($data);

        } elseif ($request->type == 'email' || $request->type == 'general' || $request->type == 'woocommerece' || $request->type == 'task_additional_price' || $request->type == 'language' || $request->type == 'case' || $request->type == 'tax' || $request->type == 'currency') {

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

        Setting::updateOrCreate(
            ['type' => $request->type],
            ['data' => $jsonData]
        );

        return redirect()->back()->with('success', 'Updated successfully');
        // return redirect()->route('setting.index')->with('success','Updated successfully');
    }

    private function uploadFile($file, $type)
    {
        $extension = $file->getClientOriginalExtension();
        $filenameToStore = $type . '.' . $extension;
        $file->move(public_path('images/'), $filenameToStore);
        return $filenameToStore;
    }

    public function emailTest(Request $request)
    {
        $admin = Auth::user();
        if ($admin && $admin->email) {
            try {
                $admin->notify(new TestNotification());
                return redirect()->back()->with('success', 'Test email sent successfully on : '. $admin->email );
            } catch (\Exception $e) {
                \Log::error('Failed to send test email: ' . $e->getMessage());
                return redirect()->back()->withErrors(['smtp' => 'Failed to send test email. Please check your SMTP configuration.']);
            }
        }

        return redirect()->route('setting.index')
            ->withErrors(['admin_email' => 'Admin email is missing or something went wrong.']);
    }
}
