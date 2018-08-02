<?php

namespace App\Http\Controllers;

use App\DiscountRule;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;

class CalculateDiscountController extends Controller {

	/**
	 * @param  DiscountRequest $request
	 * @return JsonResponse
	 */
	public function calculateDiscounts(DiscountRequest $request) {

		$discountRules = DiscountRule::all();
		$order = $request->all();
		$discounts = [];

		foreach ($discountRules as $rule) {
			/**
			 * Using laravels service provider to perform the instantiation of the
			 * discounts based on the discounts description field
			 * See app\Providers\AppServiceProvider for visualising class instantiation
			 **/
			$discountManager = app()->make($rule->description);
			$discounts[$rule->description] = $discountManager->compute($order, $rule);
		}

		return response()->json([
			'discounts' => $discounts,
		]);
	}

}
