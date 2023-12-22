<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_save_added_product(): void
    {
        $response = $this->call('POST', '/save-product', [
            'product_name' => 'xxx',
            'product_price' => '1010',
            'products_category_id_categories_id' => '19',
            'product_description' => 'xxx',
        ]);

        $response->assertStatus($response->status(), 200);
    }


    public function test_update_edited_product(): void
    {
        $response = $this->call('POST', '/update-product', [
            'product_name' => 'yyy',
            'product_price' => '1010',
            'products_category_id_categories_id' => '20',
            'product_description' => 'yyy',
        ]);

        $response->assertStatus($response->status(), 200);
    }
}
