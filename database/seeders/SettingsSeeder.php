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
                    'type'      => 'tax',
                    'data'      => '[{"name": "VAT", "status": 1, "percentage": 21}]',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'      => 'term',
                    'data'      => '[{"link": "http://185.229.32.17", "title": "I read and agree with terms of service", "is_required": "1"}, {"link": "http://185.229.32.17", "title": "I read and agree with service pricing", "is_required": "1"}, {"link": "http://185.229.32.17", "title": "I agree to receive newsletter", "is_required": "2"}, {"link": "http://185.229.32.17", "title": "I read with GDR", "is_required": "1"}]',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            Setting::insert($data);
        }
    }
}
