<?php

namespace App\Calculator;

use App\Models\Product;

class DiscountCalculator
{
    public static function calculateProductPriceAfterDiscount(Product $product): float
    {
        if ($product->discount_id === null){
            return $product->product_price;
        }

        $productPrice = $product->product_price;
        $productDiscountPercentage = $product->discount->discount_percentage;
        $productDiscountValue = ($productPrice / 100) * $productDiscountPercentage;

        return $productPrice - $productDiscountValue;
    }


    public static function calculateProductDiscountValue(Product $product): float
    {
        if ($product->discount_id === null){
            return $product->product_price;
        } 

        $productPrice = $product->product_price;
        $productDiscountPercentage = $product->discount->discount_percentage;
        $productDiscountValue = ($productPrice / 100) * $productDiscountPercentage;

        return $productDiscountValue;
    }
}

