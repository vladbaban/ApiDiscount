<?php

use App\DiscountRule;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder {

	/**
	 * Run the discount seeds.
	 *
	 * @return void
	 */
	public function run() {
		DiscountRule::truncate();

		DiscountRule::create([
			'description' => 'DiscountReceivePriceReductionForCheapestProductOutOfTwoOrMoreItemsOfACertainCategory',
			'percentage' => true,
			'value' => '20',
			'category' => 1,
			'limit' => null,
		]);

		DiscountRule::create([
			'description' => 'DiscountReceiveFreeProductWhenBuyingMoreThanThresholdAmount',
			'percentage' => false,
			'value' => '1',
			'limit' => '5',
			'category' => 2,
		]);
		DiscountRule::create([
			'description' => 'DiscountReceiveTotalOrderPriceReductionForClientsWithPreviousOrdersValueOverThreshold',
			'percentage' => true,
			'value' => '10',
			'limit' => '1000',
			'category' => null,
		]);
	}
}
