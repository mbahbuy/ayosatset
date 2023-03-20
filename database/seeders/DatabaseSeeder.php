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
        \App\Models\Category::create([
            'name' => 'Jasa',
            'slug' => 'jasa'
        ]);
        \App\Models\Category::create([
            'name' => 'Makanan & Minuman',
            'slug' => 'makanan-minuman'
        ]);
        \App\Models\Category::create([
            'name' => 'Pakaian',
            'slug' => 'pakaian'
        ]);
        \App\Models\User::create([
            'name' => 'Admin Ayosatset',
            'email' => 'Admin@ayosatset.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin12345'),
            'user_hash' => md5('Admin@ayosatset.com'),
            'status' => true,
            'admin_status' => true,
            'editor_status' => true,
        ]);
        \App\Models\User::create([
            'name' => 'Buyung Abimanyu',
            'email' => 'buyung@buyung.buyung',
            'email_verified_at' => now(),
            'password' => Hash::make('buyung'),
            'user_hash' => md5('buyung@buyung.buyung'),
            'status' => true,
            'admin_status' => false,
            'editor_status' => false,
        ]);
        \App\Models\User::create([
            'name' => 'M. Galuh Setiawan',
            'email' => 'galuh@galuh.galuh',
            'email_verified_at' => now(),
            'password' => Hash::make('galuh'),
            'user_hash' => md5('galuh@galuh.galuh'),
            'status' => true,
            'admin_status' => false,
            'editor_status' => false,
        ]);
        \App\Models\User::factory(10)
            ->create()
            ->each(function ($user) {
                $shopName = $user->name . ' Shop';
                $shopHash = md5($user->user_hash . $shopName);
                \App\Models\Shop::create([
                    'user_hash' => $user->user_hash,
                    'name' => $shopName,
                    'shop_hash' => $shopHash,
                ])
                    ->creating(function ($shop) {
                        $products = \App\Models\Product::factory(10)->make();
                        foreach ($products as $product) {
                            $caegory = fake()->randomElement(['jasa', 'makanan-minuman', 'pakaian']);
                            \App\Models\Product::create([
                                'name' => $product->name,
                                'description' => $product->description,
                                'price' => $product->price,
                                'image' => 'product/' . fake()->randomElement(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20']) . '.jpg',
                                'stock' => $product->stock,
                                'shop_hash' => $shop->shop_hash,
                                'categories' => $caegory,
                                'product_hash' => md5($shop->shop_hash . $product->name)
                            ]);
                        }
                    });
            });
    }
}
