<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() == 0) {
            $data = [
                [
                    'user_type'   => 1,
                    'first_name'  => 'Muhammad Khizer',
                    'last_name'   => 'Sajjad',
                    'phone'       => '+923094118718',
                    'email'       => 'mkhizersajjad@gmail.com',
                    'password'    => bcrypt('12345678'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_type'   => 1,
                    'first_name'  => 'Fabijus',
                    'last_name'   => 'L',
                    'phone'       => '+37061975007',
                    'email'       => 'fabijus@fabiride.com',
                    'password'    => bcrypt('12345678'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            User::insert($data);
        }
    }
}
