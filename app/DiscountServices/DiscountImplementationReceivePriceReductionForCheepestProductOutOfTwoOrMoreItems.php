<?php

namespace App\DiscountServices;

use App\DiscountRule;
use Illuminate\Support\Facades\DB;
use App\DiscountServices\DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount;

class DiscountImplementationReceivePriceReductionForCheepestProductOutOfTwoOrMoreItems implements IDiscount
{
    public function compute($orderInput, $description)
    {
        $unitPriceDiference=0;
        $discountFreeProduct = new DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount();
        $discountRules =DiscountRule::where('description', $description)->first();
        if (is_null($discountRules->category)) {
            $products = DB::table('products')->all();
        } else {
            $products =DB::table('products')->where('category', $discountRules->category)->get();
        }
        $itemsToApplyDiscount= $discountFreeProduct->getItemsByCategory($orderInput, $products);
        $unitPriceDiference = $this->findUnitPriceDiference($itemsToApplyDiscount);
        if ($unitPriceDiference) {
            $cheepestPrice = PHP_INT_MAX;
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
