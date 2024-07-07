<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Part;

class PartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Part::count() == 0) {
            $data = [
                [
                    'name'      => 'Battery',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'      => 'Charger',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'      => 'Bag',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            Part::insert($data);
        }
    }
}
