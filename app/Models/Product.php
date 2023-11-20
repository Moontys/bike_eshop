<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
