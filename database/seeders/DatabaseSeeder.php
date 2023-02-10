<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\User::create([
            'name' => 'Admin Ayosatset',
            'email' => 'Admin@ayosatset.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin12345'),
            'user_hash' => substr(md5('Admin@ayosatset.com'), 0, 8),
            'admin_status' => true,
            'editor_status' => true,
        ]);
    }
}
