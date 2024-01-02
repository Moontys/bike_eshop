<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductWithExpiredDiscountSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            'category_name' => 'Interesting Literatue',
            'created_at' => '2023-12-27 00:00:00',
            'updated_at' => '2023-12-27 00:00:00',
        ]);       

        DB::table('discounts')->insert([
            'discount_percentage' => 25,
            'discount_expiration_date' => '2023-12-27 00:00:00',
            'created_at' => '2023-12-27 00:00:00',
            'updated_at' => '2023-12-27 00:00:00',
            'discount_name' => 'Mini Deal!',
        ]);

        DB::table('products')->insert([
            'product_name' => 'Dino Killer',
            'product_price' => '25',
            'product_status' => '1',
            'product_description' => 'Best ever',
            'product_image' => 'not/fake/image.jpg',
            'category_id' => 1,
            'discount_id' => 1,
            'created_at' => '2023-12-27 00:00:00',
            'updated_at' => '2023-12-27 00:00:00',
        ]);
    }
}
