<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use DB;

class DiscountDeactivationCommand extends Command
{
    protected $signature = 'discount:deactivate';

    protected $description = 'Daily Discount Deactivate Command';

    public function handle(): int
    {
        $currentDate = new DateTime();

        $dateTo = $currentDate->format('Y-m-d') . ' 23:59:59';

        $discountsByDates = DB::table('discounts')
            ->select('discounts.id')
            ->where('discount_expiration_date', '<=', $dateTo)
            ->get();

        $discountIdsByDates = array_column($discountsByDates->toArray(), 'id');

        DB::table('products')
            ->whereIn('discount_id', $discountIdsByDates)
            ->update(['discount_id' => null]);

        return 0;
    }
}
