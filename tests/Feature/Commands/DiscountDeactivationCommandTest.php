<?php

declare(strict_types=1);

namespace Tests\Feature\Commands;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\ProductWithExpiredDiscountSeeder;
use Tests\TestCase;

class DiscountDeactivationCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_deactivates_discount_for_products(): void
    {
        $this->seed(ProductWithExpiredDiscountSeeder::class);

        $this->artisan('discount:deactivate');

        $product = Product::take(1)->first();

        $this->assertNull($product->discount_id);
    }
}