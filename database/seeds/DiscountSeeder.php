<?php

use Illuminate\Database\Seeder;
use App\DiscountRule;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiscountRule::truncate();

        DiscountRule::create([
            'description' => 'DiscountReceivePriceReductionForCheepestProductOutOfTwoOrMoreItemsOfACertainCategory',
            'percentage' => true,
            'value' => '20',
            'category' => 1,
            'limit' => null
        ]);

        DiscountRule::create([
            'description' => 'DiscountReceiveFreeProductWhenBuyingMoreThanThresholdAmount',
            'percentage' => false,
            'value' => '1',
            'limit' => '5',
            'category' => 2
        ]);
        DiscountRule::create([
            'description' => 'DiscountReceiveTotalOrderPriceReductionForClientsWithPreviosOrdersValueOverThreshold',
            'percentage' => true,
            'value' => '10',
            'limit' => '1000',
            'category' => null
        ]);
    }
}