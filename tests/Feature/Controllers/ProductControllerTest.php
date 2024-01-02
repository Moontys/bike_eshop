<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Models\Product;
use Database\Seeders\ProductWithExpiredDiscountSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_added_product(): void
    {
        $response = $this->call('POST', '/save-product', [
            'product_name' => 'xxx',
            'product_price' => '1010',
            'products_category_id_categories_id' => '19',
            'product_description' => 'xxx',
        ]);

        $response->assertStatus(302);
    }


    public function test_update_edited_product(): void
    {
        $this->seed(ProductWithExpiredDiscountSeeder::class);

        $product = Product::take(1)->first();

        $response = $this->call('POST', '/update-product', [
            'id' => $product->id,
            'product_name' => 'yyy',
            'product_price' => '1010',
            'products_category_id_categories_id' => '20',
            'product_description' => 'yyy',
        ]);

        $response->assertStatus(302);
    }
}
