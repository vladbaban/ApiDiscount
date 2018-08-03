<?php

namespace Tests\DiscountTests;

use App\DiscountRule;
use Tests\TestCase;

class DiscountTest extends TestCase {

	protected $order = [
		"id" => "3",
		"customer-id" => "2",
		"items" => [
			[
				"product-id" => "A101",
				"quantity" => "2",
				"unit-price" => "9.75",
				"total" => "19.50",
			],
			[
				"product-id" => "A102",
				"quantity" => "1",
				"unit-price" => "49.50",
				"total" => "49.50",
			],
			[
				"product-id" => "B101",
				"quantity" => "5",
				"unit-price" => "4.99",
				"total" => "24.95",
			],
			[
				"product-id" => "B102",
				"quantity" => "10",
				"unit-price" => "4.99",
				"total" => "49.90",
			],
			[
				"product-id" => "B103",
				"quantity" => "20",
				"unit-price" => "12.95",
				"total" => "259",
			],
		],
		"total" => "402.85",
	];

	/**
	 * Depending on the user and the revenue brought by him in previous orders,
	 *  and depending on the value(the discount value that is applied) and limit(the threshold value)
	 *  the test will return true or false
	 * @return bool
	 */
	public function testDiscountImplementationReceiveTotalOrderPriceReductionForClientsWithPreviousOrdersValueOverThreshold() {

		$discountRule = new DiscountRule([
			'description' => 'DiscountReceiveTotalOrderPriceReductionForClientsWithPreviousOrdersValueOverThreshold',
			'percentage' => true,
			'value' => '10',
			'limit' => '1000',
			'category' => null,
		]);
		$discountManager = app()->make($discountRule->description);
		$discount = $discountManager->compute($this->order, $discountRule);
		$this->assertNotFalse($discount);
	}

	/**
	 * Dependig on if the order has items of the desired discountRule category
	 * or none of the items has a quantity over the discountuRule limit
	 * the test will return true or false
	 * * @return bool
	 */
	public function testDiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount() {

		$discountRule = new DiscountRule([
			'description' => 'DiscountReceiveFreeProductWhenBuyingMoreThanThresholdAmount',
			'percentage' => false,
			'value' => '1',
			'limit' => '5',
			'category' => 2,
		]);
		$discountManager = app()->make($discountRule->description);
		$discount = $discountManager->compute($this->order, $discountRule);
		$this->assertNotFalse($discount);
	}

/**
 * Dependig on if the order has items of the desired discountRule category
 * or if the items have diferent prices the test will return true or false
 * @return bool
 */
	public function testDiscountImplementationReceivePriceReductionForCheapestProductOutOfTwoOrMoreItems() {

		$discountRule = new DiscountRule([
			'description' => 'DiscountReceivePriceReductionForCheapestProductOutOfTwoOrMoreItemsOfACertainCategory',
			'percentage' => true,
			'value' => '20',
			'category' => 1,
			'limit' => null,
		]);
		$discountManager = app()->make($discountRule->description);
		$discount = $discountManager->compute($this->order, $discountRule);
		$this->assertNotFalse($discount);
	}

}
