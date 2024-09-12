<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SerivceLocation;

class ServiceLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (SerivceLocation::count() == 0) {
            $data = [
                [
                    'title' => 'Deliver to office',
                    'detail' => '',
                    'fields' => json_encode([
                        [
                            'name' => 'first_name',
                            'title' => 'First Name',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter First Name'
                        ],
                        [
                            'name' => 'last_name',
                            'title' => 'Last Name',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Last Name'
                        ],
                        [
                            'name' => 'phone',
                            'title' => 'Phone Number',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Phone Number'
                        ],
                        [
                            'name' => 'email',
                            'title' => 'Email',
                            'type' => 'email',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Email'
                        ],
                        [
                            'name' => 'city',
                            'title' => 'City',
                            'type' => 'text',
                            'is_mandatory' => 2,
                            'place_holder' => 'Enter City'
                        ],
                        [
                            'name' => 'company',
                            'title' => 'Company',
                            'type' => 'text',
                            'is_mandatory' => 2,
                            'place_holder' => 'Enter Company'
                        ],
                        [
                            'name' => 'address',
                            'title' => 'Address',
                            'type' => 'textarea',
                            'is_mandatory' => 2,
                            'place_holder' => 'Enter Address'
                        ]
                    ])
                ],
                [
                    'title' => 'I will send to office',
                    'detail' => 'To our office by courier to this address:  			Technikos g. 7 Kaunas
                                To pickup points:
                                    Omniva - Kaunas, Urmo Baze
                                    LP Express - Kaunas, Urmo Baze
                                    DPD - Kaunas, Urmo Baze



                                After shipment is sent out - send us the tracking number and service order number by email - servisas@fabiride.com',
                    'fields' => json_encode([
                        [
                            'name' => 'first_name',
                            'title' => 'First Name',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter First Name'
                        ],
                        [
                            'name' => 'last_name',
                            'title' => 'Last Name',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Last Name'
                        ],
                        [
                            'name' => 'phone',
                            'title' => 'Phone Number',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Phone Number'
                        ],
                        [
                            'name' => 'email',
                            'title' => 'Email',
                            'type' => 'email',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Email'
                        ],
                        [
                            'name' => 'city',
                            'title' => 'City',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter City'
                        ],
                        [
                            'name' => 'company',
                            'title' => 'Company',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Company'
                        ],
                        [
                            'name' => 'address',
                            'title' => 'Address',
                            'type' => 'textarea',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Address'
                        ]
                    ])
                ],
                [
                    'title' => 'Engineer Invitation',
                    'detail' => 'We will contact you and let you to know when we will be able to arrive to your address.',
                    'fields' => json_encode([
                        [
                            'name' => 'first_name',
                            'title' => 'First Name',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter First Name'
                        ],
                        [
                            'name' => 'last_name',
                            'title' => 'Last Name',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Last Name'
                        ],
                        [
                            'name' => 'phone',
                            'title' => 'Phone Number',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Phone Number'
                        ],
                        [
                            'name' => 'email',
                            'title' => 'Email',
                            'type' => 'email',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Email'
                        ],
                        [
                            'name' => 'city',
                            'title' => 'City',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter City'
                        ],
                        [
                            'name' => 'company',
                            'title' => 'Company',
                            'type' => 'text',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Company'
                        ],
                        [
                            'name' => 'address',
                            'title' => 'Address',
                            'type' => 'textarea',
                            'is_mandatory' => 1,
                            'place_holder' => 'Enter Address'
                        ]
                    ])
                ],
            ];
        }

        SerivceLocation::insert($data);
    }
}
