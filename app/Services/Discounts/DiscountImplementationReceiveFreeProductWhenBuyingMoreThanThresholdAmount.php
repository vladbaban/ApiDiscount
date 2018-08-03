<?php

namespace App\Services\Discounts;

use App\DatabaseRulesManager;
use App\DiscountRule;

class DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount extends BaseDiscountService implements IDiscount {

	/**
	 * Discount Constructor
	 * @param DatabaseRulesManager $databaseRulesManager
	 */
	public function __construct(DatabaseRulesManager $databaseRulesManager) {
		$this->databaseRulesManager = $databaseRulesManager;
	}

	/**
	 * @param  array $orderInput
	 * @param  DiscountRule $rule
	 * @return array
	 */
	public function compute(array $orderInput, DiscountRule $rule) {

		// here we check if the discount is applied to all items or to a category
		$products = (is_null($rule->category)) ? $this->databaseRulesManager->getAllProducts() : $this->databaseRulesManager->getProductsByCategory($rule->category);

		$itemsFromCategory = $this->getItemsByCategory($orderInput, $products);

		foreach ($itemsFromCategory as $item) {
			if ($item["quantity"] >= $rule->limit) {
				$itemsToApplyDiscount[] = $item;
			}
		}
		if (!empty($itemsToApplyDiscount)) {
			$discounts = $this->calculateDiscountsForItems($itemsToApplyDiscount, $rule);

			return $discounts;
		} else {
			return false;
		}
	}

}
