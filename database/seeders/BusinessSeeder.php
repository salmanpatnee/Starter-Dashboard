<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $business_settings = [
            "name"                      => "Pharma Square",
            "user_id"                   => 1,
            "email_settings"            => '{"driver": "SMTP","host": "localhost","port": 456,"username": "","password": "","encryption": "SSL","from": "","name": ""}'
        ];

        Business::create($business_settings);
    }
}
