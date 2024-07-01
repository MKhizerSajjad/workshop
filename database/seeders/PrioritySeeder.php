<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Priority::count() == 0) {
            $data = [
                [
                    'name'      => 'Standard',
                    'price'     => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'      => 'Higher',
                    'price'     => 45,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'      => 'Highest',
                    'price'     => 70,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            Priority::insert($data);
        }
    }
}
