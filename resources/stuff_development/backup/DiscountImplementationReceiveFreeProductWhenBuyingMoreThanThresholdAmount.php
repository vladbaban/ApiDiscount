<?php

namespace App\DiscountServices;
use App\DiscountRule;
use Illuminate\Support\Facades\DB;

class DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount implements IDiscount 

{

	public function compute($orderInput,$description)
	{
		$discountRules =DiscountRule::where('description', $description)->first();
		$products =DB::table('products')->where('category',$discountRules->category)->get();
		$listOfDiscounts = [];
		foreach($products as $product)
			foreach($orderInput["items"] as $item)
		{
			if($product->id == $item["product-id"])
			{
				if (!$discountRules->percentage)
				{
					$limitBreak = floor($item["quantity"]/$discountRules->limit);
					$discountQuantity = $limitBreak * $discountRules->value;
					$newQuantity = $item["quantity"] + $discountQuantity; 					
 				}
				else
				{  
					$discountQuantity = ($item["total"]*$discountRules->value)/100;
					$newTotal = $item["total"] - $discountQuantity; 												
 				}

 				$newQuantity = $item["quantity"] + $discountQuantity;
              $listOfDiscounts[] = [
                        'product_id' => $product->id,
                        'new_quantity' => $newQuantity, /// add some "" or convert to a json
                        'old_quantity'=> $item["quantity"],
                        'unit_price'=>$item["unit-price"],
                        'total'=>$item["total"]
                    ];
            }
		}

		return $listOfDiscounts;	

	}


}

?>