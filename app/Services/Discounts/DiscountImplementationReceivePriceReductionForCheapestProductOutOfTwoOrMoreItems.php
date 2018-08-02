<?php

namespace App\Services\Discounts;

use App\DatabaseRulesManager;
use App\DiscountRule;

class DiscountImplementationReceivePriceReductionForCheapestProductOutOfTwoOrMoreItems extends BaseDiscountService implements IDiscount {

	/**
	 * Discount Constructor
	 * @param DatabaseRulesManager $databaseRulesManager
	 */
	public function __construct(DatabaseRulesManager $databaseRulesManager) {
		$this->databaseRulesManager = $databaseRulesManager;
	}

	/**
	 * this is the main function for this discount
	 * @param  array        $orderInput
	 * @param  DiscountRule $rule
	 * @return array|bool
	 */
	public function compute(array $orderInput, DiscountRule $rule) {

		$unitPriceDiference = 0;
		$cheapestPrice = PHP_INT_MAX;

		// here we check if the discount is applied to all items or to a category
		$products = (is_null($rule->category)) ? $this->databaseRulesManager->getAllProducts() : $this->databaseRulesManager->getProductsByCategory($rule->category);

		$itemsToApplyDiscount = $this->getItemsByCategory($orderInput, $products);
		$unitPriceDiference = $this->findUnitPriceDiference($itemsToApplyDiscount);

		//if all the items in the order and/or of the desired
		//category have the same price the discount can not be applied
		if ($unitPriceDiference) {

			//here we find the cheapest item
			foreach ($itemsToApplyDiscount as $item) {
				if ($item["unit-price"] < $cheapestPrice) {
					$cheapestPrice = $item["unit-price"];
					$cheapestItem[] = $item;
				}
			}
			$listOfDiscounts = $this->calculateDiscountsForItems($cheapestItem, $rule);

			return $listOfDiscounts;
		} else {
			return false;
		}
	}

	/**
	 * in this function we check if the desired items have diferent unit prices
	 * @param  array  $itemsToApplyDiscount
	 * @return int
	 */
	public function findUnitPriceDiference(array $itemsToApplyDiscount) {

		foreach ($itemsToApplyDiscount as $item) {
			$ItemPrice = '';
			if ($ItemPrice == $item["unit-price"]) {
				$ItemPrice = $item["unit-price"];
			} else {
				$unitPriceDiference = 1;
			}

			return $unitPriceDiference;
		}
	}
}
