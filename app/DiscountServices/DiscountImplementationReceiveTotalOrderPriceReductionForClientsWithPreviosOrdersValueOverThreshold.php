<?php

namespace App\DiscountServices;
use App\DiscountRule;
use App\User;
use Illuminate\Support\Facades\DB;
use App\DiscountServices\DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount;

class DiscountImplementationReceiveTotalOrderPriceReductionForClientsWithPreviosOrdersValueOverThreshold implements IDiscount
{

	public function compute($orderInput,$description)
	{	
		$orederDiscount = [];
		$newTotalAfterItemDiscounts =0;
		$currentClassDiscountRule =DiscountRule::where('description', $description)->first();
		$discountRules=DiscountRule::all();
		foreach($discountRules as $rule)
  		{
  			if(!($rule->description == $currentClassDiscountRule->description))
  			{
				$discountManager = app()->make($rule->description);
	  			$listOfDiscounts[] = $discountManager->compute($orderInput,$rule->description);
	  		}	  				  				
  		}
  		foreach($listOfDiscounts as $element)
	  			{
	  		foreach($element as $item)
	  			{
		  				if(array_key_exists ("total", $item ))
		 					{
							$itemTotal = $item["total"];
		  					}
		  					else
		  					{
		  					$itemTotal = $item["new_total"];
		  					}
		  					$newTotalAfterItemDiscounts += $itemTotal;
  					}
				}
  		$discountFreeProduct = new DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount();
  		
  	
		$user=User::select('name')->where('id', $orderInput["customer-id"])->first();

  		return $orderDiscount[]=
  		[
  		'client'=>$orderInput["customer-id"],
  		'client-name'=>$user["name"],
  		'totalPriceAfterItemDiscounts'=> $newTotalAfterItemDiscounts,
  		'newTotalOrderPrice'=> $discountFreeProduct->applyDiscountByModifyingPrice($newTotalAfterItemDiscounts,$currentClassDiscountRule)

  		];

		
	}





}

?>