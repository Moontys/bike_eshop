<?php

declare(strict_types=1);

namespace App;

use App\Models\Product;
use App\Calculator\DiscountCalculator;

final class Cart
{
    /**
     * @var array<int, array{qty: int, product_id: int, product_name: string, product_price: float, product_image: string, item: Product}>|null
     */
    public ?array $items = null;
    public int $totalQty = 0;
    public float $totalDiscount = 0;
    public float $totalPrice = 0;
    public float $totalPriceAfterDiscount = 0;

    public function __construct(?Cart $oldCart)
    {
        if ($oldCart !== null) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->totalDiscount = $oldCart->totalDiscount;
            $this->totalPriceAfterDiscount = $oldCart->totalPriceAfterDiscount;
        }
    }

    public function add(Product $product): void
    {
        $storedItem = [
            'qty' => 0,
            'product_id' => 0,
            'product_name' => $product->product_name,
            'product_price' => $product->product_price,
            'product_discount' => DiscountCalculator::calculateProductDiscountValue($product),
            'product_price_after_discount' => DiscountCalculator::calculateProductPriceAfterDiscount($product),
            'product_image' => $product->product_image,
            'item' => $product,
        ];

        if ($this->items !== null && array_key_exists($product->id, $this->items)) {
            $storedItem = $this->items[$product->id];
        }

        $storedItem['qty']++; 
        $storedItem['product_id'] = $product->id;
        $storedItem['product_name'] = $product->product_name;
        $storedItem['product_price'] = $product->product_price;
        $storedItem['product_discount'] = DiscountCalculator::calculateProductDiscountValue($product);
        $storedItem['product_price_after_discount'] = DiscountCalculator::calculateProductPriceAfterDiscount($product);
        $storedItem['product_image'] = $product->product_image;

        $this->totalQty++;
        $this->totalPrice += $product->product_price;
        $this->totalDiscount += $storedItem['product_discount'];
        $this->totalPriceAfterDiscount += $storedItem['product_price_after_discount'];
        $this->items[$product->id] = $storedItem;
    }

    public function updateQuantity(int $productId, int $newQuantity): void
    {
        $oldQuantity = (int)$this->items[$productId]['qty'];

        $this->totalQty -= $oldQuantity;
        $this->totalPrice -= $this->items[$productId]['product_price'] * $oldQuantity;
        $this->totalDiscount -= $this->items[$productId]['product_discount'] * $oldQuantity;
        $this->totalPriceAfterDiscount -= $this->items[$productId]['product_price_after_discount'] * $oldQuantity;

        $this->items[$productId]['qty'] = $newQuantity;
        $this->totalQty += $newQuantity;
        $this->totalPrice += $this->items[$productId]['product_price'] * $newQuantity;
        $this->totalDiscount += $this->items[$productId]['product_discount'] * $newQuantity;
        $this->totalPriceAfterDiscount += $this->items[$productId]['product_price_after_discount'] * $newQuantity;
    }

    public function removeItem(int $productId): void
    {
        $this->totalQty -= (int)$this->items[$productId]['qty'];
        $this->totalPrice -= $this->items[$productId]['product_price'] * $this->items[$productId]['qty'];
        $this->totalDiscount -= $this->items[$productId]['product_discount'] * $this->items[$productId]['qty'];
        $this->totalPriceAfterDiscount -= $this->items[$productId]['product_price_after_discount'] * $this->items[$productId]['qty'];
        
        unset($this->items[$productId]);
    }
}
