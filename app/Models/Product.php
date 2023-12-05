<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Discount;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $product_name
 * @property int $product_price
 * @property string $product_image
 * @property \DateTimeInterface $created_at
 * @property \DateTimeInterface $updated_at
 * @property int $product_status
 * @property int $category_id
 * @property int $discount_id
 * @property string $product_description
 */
class Product extends Model
{
    use HasFactory;


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }
}
