<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => 'Signature Package',
                'price' => 1500.00,
                'preparation_time' => '1 Hour',
                'serve' => 50,
                'description' => 'Enjoy a package for 50 people (Contains 25 signature waffles + 25 mini pancakes or waffles according to your choice. The Signature waffle package is distinguished by the addition of refreshing ice cream, which closes the desert files in all gatherings and has no competitor. Enjoy now with the most delicious pistachio sause you can ever taste. The most delicious caramel sauce will sweeten your days. Belgian chocolate tastes like it melts your heart before it enteres your mouth. This package includes the worker. )',
                'image' => 'prod-01.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Cookie and Waffle Package',
                'price' => 1500.00,
                'preparation_time' => '1 Hour',
                'serve' => 50,
                'description' => 'Enjoy the 50 person package (Contains 25 waffle coockiesss + 25 mini pancakes or waffles according to your choice). Enjoy these soft and crunchy waffle coockies at the same time !. Distinctive with its taste that melts in the mouth!. In addition to sauces of your choice: - Belgian chocolate sauce  - White chocolate sauce - Pistachio sauce.   The package includes the worker.',
                'image' => 'prod-02.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Waffle Stick',
                'price' => 1000,
                'preparation_time' => '1 Hour',
                'serve' => 50,
                'description' => 'Enjoy the 50 person package (Contains 25 waffle coockiesss + 25 mini pancakes or waffles according to your choice). Enjoy these soft and crunchy waffle coockies at the same time !. Distinctive with its taste that melts in the mouth!. In addition to sauces of your choice: - Belgian chocolate sauce  - White chocolate sauce - Pistachio sauce.   The package includes the worker.',
                'image' => 'prod-03.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Classic Package',
                'price' => 1000,
                'preparation_time' => '1 Hour',
                'serve' => 50,
                'description' => 'Enjoy the 50 person package (Contains 25 waffle coockiesss + 25 mini pancakes or waffles according to your choice). Enjoy these soft and crunchy waffle coockies at the same time !. Distinctive with its taste that melts in the mouth!. In addition to sauces of your choice: - Belgian chocolate sauce  - White chocolate sauce - Pistachio sauce.   The package includes the worker.',
                'image' => 'prod-04.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
