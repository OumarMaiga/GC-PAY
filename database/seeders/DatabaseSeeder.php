<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        \App\Models\User::create([
            'email' => 'admin@gcpay.com',
            'telephone' => '+223 20 55 36 14',
            'password' => Hash::make('password123'),
            'type' => 'admin-systeme',
            'etat' => 1,
        ])->save();
    }
}
