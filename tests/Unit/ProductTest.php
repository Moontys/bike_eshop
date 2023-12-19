<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_saveAddedProduct()
    {
        $response = $this->call('POST', '/save-product', [
            'product_name' => 'xxx',
            'product_price' => '1010',
            'products_category_id_categories_id' => '19',
            'product_description' => 'xxx',
        ]);

        $response->assertStatus($response->status(), 200);
    }
}
