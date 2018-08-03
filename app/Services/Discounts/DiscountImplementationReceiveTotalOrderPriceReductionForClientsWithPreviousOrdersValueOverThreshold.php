<?php

namespace App\Services\Discounts;

use App\DatabaseRulesManager;
use App\DiscountRule;

class DiscountImplementationReceiveTotalOrderPriceReductionForClientsWithPreviousOrdersValueOverThreshold extends BaseDiscountService implements IDiscount {

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
	 * @return array|bool
	 */
	public function compute(array $orderInput, DiscountRule $rule) {
		$orederDiscount = [];
		//$databaseRulesManager = new DatabaseRulesManager();
		$user = $this->databaseRulesManager->getUserById($orderInput["customer-id"]);
		if ($user->revenue > $rule->limit) {
			$newTotalOrderPrice = round($this->applyDiscountByModifyingPrice($orderInput["total"], $rule), 3);

			// this discount function has a diferent response format
			// because it does not apply to am item but to the entire order
			return $orderDiscount[] =
				[
				'client' => $orderInput["customer-id"],
				'client-name' => $user["name"],
				'discountValues' => $rule->value . "%",
				'newTotalOrderPrice' => $newTotalOrderPrice,
			];
		} else {
			return false;
		}
	}
}
