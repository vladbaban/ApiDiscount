<?php

namespace App\DiscountServices;

use App\DiscountRule;
use Illuminate\Support\Facades\DB;
use App\DiscountServices\DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount;

class DiscountImplementationReceivePriceReductionForCheepestProductOutOfTwoOrMoreItems implements IDiscount
{//this is the main function for this discount 
    public function compute($orderInput, $description)
    {   $unitPriceDiference=0;
        $cheepestPrice = PHP_INT_MAX;
        $discountFreeProduct = new DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount();
        $discountRules =DiscountRule::where('description', $description)->first();
    // here we check if the discount is applied to all items or to a category
        if (is_null($discountRules->category)) {
            $products = DB::table('products')->all();
        } else {
            $products =DB::table('products')->where('category', $discountRules->category)->get();
        }
        $itemsToApplyDiscount= $discountFreeProduct->getItemsByCategory($orderInput, $products);
        $unitPriceDiference = $this->findUnitPriceDiference($itemsToApplyDiscount);
     //if all the items in the order and/or of the desired 
     //category have the same price the discount can not be applied
        if ($unitPriceDiference) {
            //here we find the cheepest item
            foreach ($itemsToApplyDiscount as $item) {
                if ($item["unit-price"]<$cheepestPrice) {
                    $cheepestPrice = $item["unit-price"];
                    $cheepestItem[]=$item;
                }
            }
            $listOfDiscounts= $discountFreeProduct->calculateDiscountsForItems($cheepestItem, $discountRules);
            return $listOfDiscounts;
        } else {
            return "";
        }
    }
// in this function we check if the desired items have diferent unit prices
    public function findUnitPriceDiference($itemsToApplyDiscount)
    {
        foreach ($itemsToApplyDiscount as $item) {
            $ItemPrice='';
            if ($ItemPrice == $item["unit-price"]) {
                $ItemPrice = $item["unit-price"];
            } else {
                $unitPriceDiference = 1;
            }
            return $unitPriceDiference;
        }
    }
}
