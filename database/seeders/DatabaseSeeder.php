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
        ])->creating(function ($admin) {
            \App\Models\Address::create([
                'user_hash' => $admin->user_hash,
                'province_id' => 11,
                'city_id' => 444,
                'address' => 'jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A',
                'phone' => '081234567890',
                'status' => true,
                'use' => true
            ]);
        });
        \App\Models\User::create([
            'name' => 'Buyung',
            'email' => 'buyung@buyung.buyung',
            'email_verified_at' => now(),
            'password' => Hash::make('buyung'),
            'user_hash' => md5('buyung@buyung.buyung'),
            'status' => true,
            'admin_status' => false,
            'editor_status' => false,
        ])->creating(function ($buyung) {
            \App\Models\Address::create([
                'user_hash' => $buyung->user_hash,
                'province_id' => 11,
                'city_id' => 444,
                'address' => 'jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A',
                'phone' => '081234567890',
                'status' => true,
                'use' => true
            ]);
        });
        \App\Models\User::create([
            'name' => 'Galuh',
            'email' => 'galuh@galuh.galuh',
            'email_verified_at' => now(),
            'password' => Hash::make('galuh'),
            'user_hash' => md5('galuh@galuh.galuh'),
            'status' => true,
            'admin_status' => false,
            'editor_status' => false,
        ])->creating(function ($galuh) {
            \App\Models\Address::create([
                'user_hash' => $galuh->user_hash,
                'province_id' => 11,
                'city_id' => 444,
                'address' => 'jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A',
                'phone' => '081234567890',
                'status' => true,
                'use' => true
            ]);
        });
        \App\Models\User::create([
            'name' => 'Wawan',
            'email' => 'wawan@wawan.wawan',
            'email_verified_at' => now(),
            'password' => Hash::make('wawan'),
            'user_hash' => md5('wawan@wawan.wawan'),
            'status' => true,
            'admin_status' => false,
            'editor_status' => false,
        ])->creating(function ($wawan) {
            \App\Models\Address::create([
                'user_hash' => $wawan->user_hash,
                'province_id' => 11,
                'city_id' => 444,
                'address' => 'jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A',
                'phone' => '081234567890',
                'status' => true,
                'use' => true
            ]);
        });
        \App\Models\Shop::create([
            'user_hash' => md5('wawan@wawan.wawan'),
            'name' => 'Wawan Shop',
            'shop_hash' => md5('wawan@wawan.wawan' . 'Wawan Shop'),
        ])
            ->creating(function ($shop) {
                \App\Models\Address::create([
                    'shop_hash' => $shop->shop_hash,
                    'province_id' => 6,
                    'city_id' => 152,
                    'address' => 'east tejturi bazar, dhaka-1200. word no-04, road no-13/c, house no-4/b',
                    'phone' => '081234567890',
                    'status' => true,
                    'use' => true
                ]);

                $products = \App\Models\Product::factory(50)->make();
                foreach ($products as $product) {
                    $caegory = fake()->randomElement(['jasa', 'makanan-minuman', 'pakaian']);
                    \App\Models\Product::create([
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $product->price,
                        'image' => 'product/' . fake()->randomElement(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20']) . '.jpg',
                        'quantity' => $product->quantity,
                        'shop_hash' => $shop->shop_hash,
                        'categories' => $caegory,
                        'product_hash' => md5($shop->shop_hash . $product->name)
                    ]);
                }
            });
        \App\Models\User::create([
            'name' => 'Irfan',
            'email' => 'irfan@irfan.irfan',
            'email_verified_at' => now(),
            'password' => Hash::make('irfan'),
            'user_hash' => md5('irfan@irfan.irfan'),
            'status' => true,
            'admin_status' => false,
            'editor_status' => false,
        ])->creating(function ($irfan) {
            \App\Models\Address::create([
                'user_hash' => $irfan->user_hash,
                'province_id' => 11,
                'city_id' => 444,
                'address' => 'jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A',
                'phone' => '081234567890',
                'status' => true,
                'use' => true
            ]);
        });
        \App\Models\Shop::create([
            'user_hash' => md5('irfan@irfan.irfan'),
            'name' => 'Irfan Shop',
            'shop_hash' => md5('irfan@irfan.irfan' . 'Irfan Shop'),
        ])
            ->creating(function ($shop) {
                \App\Models\Address::create([
                    'shop_hash' => $shop->shop_hash,
                    'province_id' => 6,
                    'city_id' => 152,
                    'address' => 'east tejturi bazar, dhaka-1200. word no-04, road no-13/c, house no-4/b',
                    'phone' => '081234567890',
                    'status' => true,
                    'use' => true
                ]);

                $products = \App\Models\Product::factory(50)->make();
                foreach ($products as $product) {
                    $caegory = fake()->randomElement(['jasa', 'makanan-minuman', 'pakaian']);
                    \App\Models\Product::create([
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $product->price,
                        'image' => 'product/' . fake()->randomElement(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20']) . '.jpg',
                        'quantity' => $product->quantity,
                        'shop_hash' => $shop->shop_hash,
                        'categories' => $caegory,
                        'product_hash' => md5($shop->shop_hash . $product->name)
                    ]);
                }
            });
        \App\Models\User::create([
            'name' => 'Faizul',
            'email' => 'faizul@faizul.faizul',
            'email_verified_at' => now(),
            'password' => Hash::make('faizul'),
            'user_hash' => md5('faizul@faizul.faizul'),
            'status' => true,
            'admin_status' => false,
            'editor_status' => false,
        ])->creating(function ($user) {
            \App\Models\Address::create([
                'user_hash' => $user->user_hash,
                'province_id' => 11,
                'city_id' => 444,
                'address' => 'jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A',
                'phone' => '081234567890',
                'status' => true,
                'use' => true
            ]);
        });
        \App\Models\Shop::create([
            'user_hash' => md5('faizul@faizul.faizul'),
            'name' => 'Faizul Shop',
            'shop_hash' => md5('faizul@faizul.faizul' . 'Faizul Shop'),
        ])
            ->creating(function ($shop) {
                \App\Models\Address::create([
                    'shop_hash' => $shop->shop_hash,
                    'province_id' => 6,
                    'city_id' => 152,
                    'address' => 'east tejturi bazar, dhaka-1200. word no-04, road no-13/c, house no-4/b',
                    'phone' => '081234567890',
                    'status' => true,
                    'use' => true
                ]);

                $products = \App\Models\Product::factory(50)->make();
                foreach ($products as $product) {
                    $caegory = fake()->randomElement(['jasa', 'makanan-minuman', 'pakaian']);
                    \App\Models\Product::create([
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $product->price,
                        'image' => 'product/' . fake()->randomElement(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20']) . '.jpg',
                        'quantity' => $product->quantity,
                        'shop_hash' => $shop->shop_hash,
                        'categories' => $caegory,
                        'product_hash' => md5($shop->shop_hash . $product->name)
                    ]);
                }
            });
        // \App\Models\User::factory(10)
        //     ->create()
        //     ->each(function ($user) {
        //         \App\Models\Address::create([
        //             'user_hash' => $user->user_hash,
        //             'province_id' => 6,
        //             'city_id' => 152,
        //             'address' => 'east tejturi bazar, dhaka-1200. word no-04, road no-13/c, house no-4/b',
        //             'phone' => '081234567890',
        //             'status' => true,
        //             'use' => true
        //         ]);

        //         $shopName = $user->name . ' Shop';
        //         $shopHash = md5($user->user_hash . $shopName);

        //         \App\Models\Shop::create([
        //             'user_hash' => $user->user_hash,
        //             'name' => $shopName,
        //             'shop_hash' => $shopHash,
        //         ])
        //             ->creating(function ($shop) {
        //                 \App\Models\Address::create([
        //                     'shop_hash' => $shop->shop_hash,
        //                     'province_id' => 6,
        //                     'city_id' => 152,
        //                     'address' => 'east tejturi bazar, dhaka-1200. word no-04, road no-13/c, house no-4/b',
        //                     'phone' => '081234567890',
        //                     'status' => true,
        //                     'use' => true
        //                 ]);

        //                 $products = \App\Models\Product::factory(10)->make();
        //                 foreach ($products as $product) {
        //                     $caegory = fake()->randomElement(['jasa', 'makanan-minuman', 'pakaian']);
        //                     \App\Models\Product::create([
        //                         'name' => $product->name,
        //                         'description' => $product->description,
        //                         'price' => $product->price,
        //                         'image' => 'product/' . fake()->randomElement(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20']) . '.jpg',
        //                         'quantity' => $product->quantity,
        //                         'shop_hash' => $shop->shop_hash,
        //                         'categories' => $caegory,
        //                         'product_hash' => md5($shop->shop_hash . $product->name)
        //                     ]);
        //                 }
        //             });
        //     });
    }
}
