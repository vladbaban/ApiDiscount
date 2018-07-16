<?php

namespace App\DiscountServices;
use Illuminate\Support\Facades\DB;

class DiscoutDependantOnQuantityAndCategory_AddingToQuantityEfect implements IDiscount 

{

	public function compute($orderInput)
	{
		$discount =DB::table('discounts')->where('description','QuantityOfProduct')->get()->first();
		$products =DB::table('products')->where('category','2')->get();
		$limit = $discount->limit;
		$value = $discount->value;
		$DiscountType = $discount->percentage;
		$orderItems = $orderInput["items"];

		foreach($products as $product)
			foreach($orderItems as $item)
		{
			if($product->id ==$item["product-id"])
				if ($DiscountType)
				{
					///!!!!!!!!
 					$limitBreak = floor($item["quantity"]/$limit);
 					$discountQuantity = $limitBreak*$value;
 					$item["quantity"] += $discountQuantity;
 					
 
				}
				else
				{  
					 /////!!!!!
					$limitBreak = floor($item["quantity"]-$limit);
 					$discountQuantity = $limitBreak*$value;
 					$item["quantity"] += $discountQuantity;
				}
		}

		return $orderInput;	

	}








	public function respond($val)
	{
	return $val;	
	}
	


}

?>