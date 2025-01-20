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

        // Truncate the table to remove existing data
        Setting::truncate();

        // if (Setting::count() == 0) {
            $data = [
                [
                    'type'      => 'general',
                    'data'      => '{"website_name": "FabiRide", "report_company": "FabiRide", "report_email": "customer@fabiRide.com", "developed_by": "The Tech Shelf"}', //,  "currency": "1", "case_prefix": "CASE-"
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'business_information',
                    'data'      => '{"company_name": "FabiRide", "company_email": "customer@fabiRide.com", "company_phone": "+1234567890", "company_website": "https://fabiride.lt", "company_address": "123 Street, City", "working_days": ["Mon", "Tue", "Wed", "Thu", "Fri"], "working_hours": {"start": "09:00", "end": "17:00"}, "main_color": "", "report_invoice_logo": "report_invoice_logo.jpg", "favicon": "favicon.ico", "logo": "logo.jpg"}',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'email',
                    // 'data'      => '[{"invoice_email": "invoice@mywebsite.com", "notification_email": "notifications@mywebsite.com", "homepage_email": "contact@mywebsite.com"}]',
                    'data'      => '{"report_email": "customer@fabiRide.com", "mail_mailer": "smtp", "mail_host": "mail.mkhizersajjad.com", "mail_port": 587, "mail_username": "info@mkhizersajjad.com", "mail_password": "mail_mks@123", "mail_encryption": "tls", "mail_from_address": "info@mkhizersajjad.com", "mail_from_name": "FabiRide"}',
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
                    'type'      => 'bank_accounts',
                    'data'      => '[
                        {
                            "account_name": "John Doe",
                            "account_number": "1234567890",
                            "bank_name": "Bank of Example",
                            "swift_code": "EXAMPLSWIFT",
                            "iban": "GB33BUKB20201555555555"
                        },
                        {
                            "account_name": "Jane Smith",
                            "account_number": "0987654321",
                            "bank_name": "Another Bank",
                            "swift_code": "ANOTHERSWIFT",
                            "iban": "GB33BUKB20201555555522"
                        }
                    ]',
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
                    'type'      => 'task_additional_price',
                    'data'      => '{"name": "inspection_diagnose", "amount": 35}',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'term',
                    'data'      => '[{"link": "http://185.229.32.17", "title": "I read and agree with terms of service", "is_required": "1"}, {"link": "http://185.229.32.17", "title": "I read and agree with service pricing", "is_required": "1"}, {"link": "http://185.229.32.17", "title": "I read with GDR", "is_required": "1"}]',
                    // , {"link": "http://185.229.32.17", "title": "I agree to receive newsletter", "is_required": "2"}
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'woocommerece',
                    'data'      => '{"base_url": "https://fabiride.lt", "consumer_key": "ck_dcbbdf7257210c6ec110cfc9ab1c9b04d8678701", "consumer_secret": "cs_1d8ac8681c8c09cf5fe89dc017780fa5394f129c"}',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'language',
                    'data'      => '{"language": "en"}',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'case',
                    'data'      => '{"case_prefix": "FR-"}',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'currency',
                    'data'      => '{"currency": "$"}',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type'      => 'currencies',
                    'data'      => '[{"name": "EUR", "symbol": "€", "status": 1}, {"name": "USD", "symbol": "$", "status": 1}, {"name": "GBP", "symbol": "£", "status": 1}]',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            Setting::insert($data);
        // }
    }
}
