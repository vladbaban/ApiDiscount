<?php

namespace App\DiscountServices;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DiscoutDependantOnPriceAndCategory_TotalPriceReductionEfect implements IDiscount 

{

	public function compute($orderInput)
	{
		$discount =DB::table('discounts')->where('description','QuantityOfProduct')->get()->first();
		$products =DB::table('products')->where('category','1')->get();
		$limit = $discount->limit;
		$value = $discount->value;
		$DiscountType = $discount->percentage;
		$orderItems = $orderInput["items"];

		foreach($products as $product)
			foreach($orderItems as $item)
		{
			if($product->id ==$item["product-id"])
			{	
				//$cheepProduct = ($cheepPrice>$item["unit-price"])? '' : $item["product-id"]);
				//$cheepPrice = $item["unit-Price"];
				if ($cheepPrice>$item["unit-price"]){}
				else
				{
					$cheepProduct = $item["product-id"];
					$cheepPrice = $item["unit-price"]
				}
				request()->where(["unit-price"=>$item["product-id"]])/// query request larave seeee?????????
			
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