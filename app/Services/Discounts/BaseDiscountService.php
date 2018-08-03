<?php

namespace App\Services\Discounts;

use App\DiscountRule;
use Illuminate\Database\Eloquent\Collection;

class BaseDiscountService {

	/**
	 * calculateDiscountsForItems here we decide which result structure to use for the current discount and item
	 * @param  array $itemsToApplyDiscount
	 * @param  DiscoutRule $discountRules
	 * @return array
	 */
	public function calculateDiscountsForItems(array $itemsToApplyDiscount, DiscountRule $rule) {

		foreach ($itemsToApplyDiscount as $item) {
			if (!$rule->percentage) {
				$listOfDiscounts[] =
					[
					'product_id' => $item["product-id"],
					'discountThreshold' => $rule->limit . " products",
					'old_quantity' => $item["quantity"],
					'new_quantity' => $this->applyDiscountByAddingToQuantity($item["quantity"], $rule),
					'unit_price' => $item["unit-price"],
					'total' => $item["total"],
				];
			} else {
				$listOfDiscounts[] =
					[
					'product_id' => $item["product-id"],
					'quantity' => $item["quantity"],
					'unit_price' => $item["unit-price"],
					'discoutValue' => $rule->value . "%",
					'old_total' => $item["total"],
					'new_total' => $this->applyDiscountByModifyingPrice($item["total"], $rule),
				];
			}
		}

		return $listOfDiscounts;
	}

	/**
	 * if a discount is applyed to a certain category we can use this function to return all items of that category
	 * @param array $orderInput
	 * @param Collection $products
	 * @return array
	 **/
	public function getItemsByCategory(array $orderInput, Collection $products) {

		$discountCategoryItems = [];
		foreach ($products as $product) {
			foreach ($orderInput["items"] as $item) {
				if ($product->productId == $item["product-id"]) {
					$discountCategoryItems[] = $item;
				}
			}
		}
		return $discountCategoryItems;
	}

	/**
	 * calculates the discout if it adds to quantitiy
	 * @param  string $quantity
	 * @param  DiscountRule $rule
	 * @return float
	 */
	public function applyDiscountByAddingToQuantity(string $quantity, DiscountRule $rule) {
		$limitBreak = floor($quantity / $rule->limit);
		$discountQuantity = $limitBreak * $rule->value;
		$newQuantity = $quantity + $discountQuantity;

		return $newQuantity;
	}

	/**
	 * this fucntion calculates discounts if it reduces total price by a percent
	 * @param  string $total
	 * @param  DiscountRule $rule
	 * @return float
	 */
	public function applyDiscountByModifyingPrice(string $total, DiscountRule $rule) {
		$discountQuantity = ($total * $rule->value) / 100;
		$newTotal = $total - $discountQuantity;

		return $newTotal;
	}
}
