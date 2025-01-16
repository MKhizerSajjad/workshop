<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

class AppSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Fetch the 'general' settings from the database
        $generalSettings = Setting::where('type', 'general')->first();
        $emailSettings = Setting::where('type', 'email_settings')->first();
        $businessInformation = Setting::where('type', 'business_information')->first();
        $wcInformation = Setting::where('type', 'woocommerece')->first();

        // If general settings exist, update APP_NAME dynamically
        if ($generalSettings) {
            // Decode the 'data' column which is in JSON format
            $settingsData = json_decode($generalSettings->data, true);

            if (isset($settingsData['website_name'])) {
                $websiteName = $settingsData['website_name'];
                config(['app.name' => $websiteName]);
            }

            if (isset($settingsData['report_company'])) {
                $websiteName = $settingsData['report_company'];
                config(['app.report_company' => $websiteName]);
            }

            if (isset($settingsData['report_email'])) {
                $websiteName = $settingsData['report_email'];
                config(['app.report_email' => $websiteName]);
            }

            if (isset($settingsData['developed_by'])) {
                $developedBy = $settingsData['developed_by'];
                config(['app.developed_by' => $developedBy]);
            }

            if (isset($settingsData['case_prefix'])) {
                $casePrefix = $settingsData['case_prefix'];
                config(['app.case_prefix' => $casePrefix]);
            }

            if (isset($settingsData['currency'])) {
                $currency = $settingsData['currency'];
                config(['app.currency' => $currency]);
            }
        }


        if ($businessInformation) {
            // Decode the 'data' column which is in JSON format
            $businessInformationData = json_decode($businessInformation->data, true);

            if (isset($businessInformationData['main_color'])) {
                $main_color = $businessInformationData['main_color'];
                config(['app.main_color' => $main_color]);
            }

            if (isset($businessInformationData['report_invoice_logo'])) {
                $reportInvoiceLogo = $businessInformationData['report_invoice_logo'];
                config(['app.report_invoice_logo' => $reportInvoiceLogo]);
            }

            if (isset($businessInformationData['logo'])) {
                $logo = $businessInformationData['logo'];
                config(['app.logo' => $logo]);
            }

            if (isset($businessInformationData['favicon'])) {
                $favicon = $businessInformationData['favicon'];
                config(['app.favicon' => $favicon]);
            }

            if (isset($businessInformationData['company_name'])) {
                $company_name = $businessInformationData['company_name'];
                config(['app.company_name' => $company_name]);
            }

            if (isset($businessInformationData['company_email'])) {
                $company_email = $businessInformationData['company_email'];
                config(['app.company_email' => $company_email]);
            }

            if (isset($businessInformationData['company_phone'])) {
                $company_phone = $businessInformationData['company_phone'];
                config(['app.company_phone' => $company_phone]);
            }

            if (isset($businessInformationData['company_address'])) {
                $company_address = $businessInformationData['company_address'];
                config(['app.company_address' => $company_address]);
            }

            if (isset($businessInformationData['working_hours'])) {
                $working_hours_start = $businessInformationData['working_hours']['start'];
                $working_hours_end = $businessInformationData['working_hours']['end'];
                config(['app.working_hours_start' => $working_hours_start]);
                config(['app.working_hours_end' => $working_hours_end]);
            }
        }


        // If email settings exist, update email configurations dynamically
        // Ensure the settings are available before applying
        if ($emailSettings && $emailSettings->data) {
            $emailData = json_decode($emailSettings->data, true);

            // Ensure that we have the necessary keys before attempting to configure
            if ($emailData) {
                if (isset($emailData['mail_mailer'])) {
                    config(['mail.default' => $emailData['mail_mailer']]);
                }
                if (isset($emailData['mail_host'])) {
                    config(['mail.mailers.smtp.host' => $emailData['mail_host']]);
                }
                if (isset($emailData['mail_port'])) {
                    config(['mail.mailers.smtp.port' => $emailData['mail_port']]);
                }
                if (isset($emailData['mail_username'])) {
                    config(['mail.mailers.smtp.username' => $emailData['mail_username']]);
                }
                if (isset($emailData['mail_password'])) {
                    config(['mail.mailers.smtp.password' => $emailData['mail_password']]);
                }
                if (isset($emailData['mail_encryption'])) {
                    config(['mail.mailers.smtp.encryption' => $emailData['mail_encryption']]);
                }
                if (isset($emailData['mail_from_address'])) {
                    config(['mail.from.address' => $emailData['mail_from_address']]);
                }
                if (isset($emailData['mail_from_name'])) {
                    config(['mail.from.name' => $emailData['mail_from_name']]);
                }
            }
        } else {
            // Handle the case where email settings are not found in DB (optional fallback)
            \Log::warning('Email settings not found or malformed in the database');
        }

        if ($wcInformation) {
            // Woocommerce
            $wcData = json_decode($wcInformation->data, true);

            if (isset($wcData['website'])) {
                $website = $wcData['website'];
                config(['app.wc_website' => $website]);
            }

            if (isset($wcData['consumer_key'])) {
                $wc_consumer_key = $wcData['consumer_key'];
                config(['app.consumer_key' => $wc_consumer_key]);
            }

            if (isset($wcData['consumer_secret'])) {
                $wc_consumer_secret = $wcData['consumer_secret'];
                config(['app.consumer_secret' => $wc_consumer_secret]);
            }
        }
    }
}
