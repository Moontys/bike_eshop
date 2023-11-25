<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Contracts\View\View;

class DiscountController extends Controller
{
    public function allDiscounts(): View
    {
        $discounts = Discount::All();

        return view('admin.all_discounts')->with('allDiscounts', $discounts);
    }
}
