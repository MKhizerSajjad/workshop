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

        // If general settings exist, update APP_NAME dynamically
        if ($generalSettings) {
            // Decode the 'data' column which is in JSON format
            $settingsData = json_decode($generalSettings->data, true);

            // Override APP_NAME if 'website_name' exists in the settings data
            if (isset($settingsData['website_name'])) {
                $websiteName = $settingsData['website_name'];
                config(['app.name' => $websiteName]);  // Override APP_NAME dynamically
            }

            // Set the developed_by (or copyright company name)
            if (isset($settingsData['developed_by'])) {
                $developedBy = $settingsData['developed_by'];
                config(['app.developed_by' => $developedBy]);  // Dynamically set the company name
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
    }
}
