<?php

namespace App\Calculator;

use App\Models\Product;

class DiscountCalculator
{
    public static function calculateForProduct(Product $product): float
    {
        if ($product->discount_id === null){
            return $product->product_price;
        } 

        $productPrice = $product->product_price; //200
        $discountPercentage = $product->discount->discount_percentage; //10%
        $discount = ($productPrice/100)*$discountPercentage;

        return $productPrice - $discount;
    }
}

