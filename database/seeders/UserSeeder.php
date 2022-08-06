<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'salmanpatni92@gmail.com',
            'password' => '123123',
            'status' => 'Active',
        ]);

        $superAdmin->assignRole('Super Admin');
    }
}
