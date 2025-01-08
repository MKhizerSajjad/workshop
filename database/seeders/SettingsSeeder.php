<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Setting::count() == 0) {
            $data = [
                [
                    'type'      => 'general',
                    'data'      => '{"website_name": "FabiRide", "developed_by": "The Tech Shelf", "currency": "USD", "case_prefix": "CASE-"}',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'business_information',
                    'data'      => '{"company_name": "FabiRide", "company_email": "customer@fabiRide.com", "company_phone": "+1234567890", "company_website": "https://fabiride.lt", "company_address": "123 Street, City", "working_days": ["Mon", "Tue", "Wed", "Thu", "Fri"], "working_hours": {"start": "09:00", "end": "17:00"}, "logo": "logo.jpg", "favicon": "favicon.ico"}',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'email_settings',
                    // 'data'      => '[{"invoice_email": "invoice@mywebsite.com", "notification_email": "notifications@mywebsite.com", "homepage_email": "contact@mywebsite.com"}]',
                    'data'      => '{"mail_mailer": "smtp", "mail_host": "mail.mkhizersajjad.com", "mail_port": 587, "mail_username": "info@mkhizersajjad.com", "mail_password": "mail_mks@123", "mail_encryption": "tls", "mail_from_address": "info@mkhizersajjad.com", "mail_from_name": "FabiRide"}',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'payments',
                    'data'      => '[{"stripe": {"enabled": true, "api_key": "stripe_api_key"}, "paypal": {"enabled": false}, "cash_payment_enabled": true}]',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'tax',
                    'data'      => '[{"name": "VAT", "status": 1, "percentage": 21}]',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'term',
                    'data'      => '[{"link": "http://185.229.32.17", "title": "I read and agree with terms of service", "is_required": "1"}, {"link": "http://185.229.32.17", "title": "I read and agree with service pricing", "is_required": "1"}, {"link": "http://185.229.32.17", "title": "I agree to receive newsletter", "is_required": "2"}, {"link": "http://185.229.32.17", "title": "I read with GDR", "is_required": "1"}]',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            Setting::insert($data);
        }
    }
}
