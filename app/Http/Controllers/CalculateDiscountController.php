<?php

namespace App\Http\Controllers;

use App\DiscountRule;
use Illuminate\Http\Request;


class CalculateDiscountController extends Controller
{
 public function calculateDiscounts(Request $request)
    {
  	$discountRules=DiscountRule::all();
  	$order= $request->all();
	   $discounts = [];
  		foreach($discountRules as $rule)
  		{
  			$discountManager = app()->make($rule->description);
  			$discounts[$rule->description] = $discountManager->compute($order,$rule->description);
  		}
    
    return [
            'discounts' => $discounts
        ];

    }

}
