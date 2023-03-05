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
            'status' => true,
            'admin_status' => true,
            'editor_status' => true,
        ]);
        \App\Models\User::create([
            'name' => 'Buyung Abimanyu',
            'email' => 'buyung@buyung.buyung',
            'email_verified_at' => now(),
            'password' => Hash::make('buyung'),
            'user_hash' => substr(md5('buyung@buyung.buyung'), 0, 8),
            'status' => true,
            'admin_status' => false,
            'editor_status' => false,
        ]);
        \App\Models\User::create([
            'name' => 'M. Galuh Setiawan',
            'email' => 'galuh@galuh.galuh',
            'email_verified_at' => now(),
            'password' => Hash::make('galuh'),
            'user_hash' => substr(md5('galuh@galuh.galuh'), 0, 8),
            'status' => true,
            'admin_status' => false,
            'editor_status' => false,
        ]);
        \App\Models\Shop::create([
            'user_hash' => substr(md5('Admin@ayosatset.com'), 0, 8),
            'name' => 'Admin Ayosatset',
            'shop_hash' => substr(md5(substr(md5('Admin@ayosatset.com'), 0, 8) . 'Admin Ayosatset'), 0, 12),
        ]);
        \App\Models\Shop::create([
            'user_hash' => substr(md5('buyung@buyung.buyung'), 0, 8),
            'name' => 'Buyung Shop',
            'shop_hash' => substr(md5(substr(md5('buyung@buyung.buyung'), 0, 8) . 'Buyung Shop'), 0, 12),
        ]);
        \App\Models\Category::create([
            'name' => 'Jasa',
            'slug' => 'jasa'
        ]);
    }
}
