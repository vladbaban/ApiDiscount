<?php

namespace App\DiscountServices;

use App\DiscountRule;
use Illuminate\Support\Facades\DB;

class DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount implements IDiscount
{
    public function compute($orderInput, $description)
    {
        $listOfDiscounts = [];
        $discountRules =DiscountRule::where('description', $description)->first();
        if (is_null($discountRules->category)) {
            $products = DB::table('products')->all();
        } else {
            $products =DB::table('products')->where('category', $discountRules->category)->get();
        }
        $itemsToApplyDiscount= $this->getItemsByCategory($orderInput, $products);
        $Discounts= $this->calculateDiscountsForItems($itemsToApplyDiscount, $discountRules);
        return $Discounts;
    }


    public function calculateDiscountsForItems($itemsToApplyDiscount, $discountRules)
    {
        foreach ($itemsToApplyDiscount as $item) {
            if (!$discountRules->percentage) {
                $listOfDiscounts[]=
                        [
                        'product_id' => $item["product-id"],
                        'discountThreshold'=>$discountRules->limit." products",
                        'old_quantity'=> $item["quantity"],
                        'new_quantity' => $this->applyDiscountByAddingToQuantity($item["quantity"], $discountRules),
                        'unit_price'=>$item["unit-price"],
                        'total'=>$item["total"]
                        ];
            } else {
                $listOfDiscounts[]=
                         [
                         'product_id' => $item["product-id"],
                        'quantity'=> $item["quantity"],
                        'unit_price'=>$item["unit-price"],
                        'discoutValue'=>$discountRules->value."%",
                        'old_total'=>$item["total"],
                        'new_total' =>  $this->applyDiscountByModifyingPrice($item["total"], $discountRules),
                        ];
            }
        }
        return $listOfDiscounts;
    }
    




    public function getItemsByCategory($orderInput, $products)
    {
        foreach ($products as $product) {
            foreach ($orderInput["items"] as $item) {
                if ($product->id == $item["product-id"]) {
                    $disountCategoryItems[] = $item;
                }
            }
        }
        return $disountCategoryItems;
    }


    public function applyDiscountByAddingToQuantity($quantity, $discountRules)
    {
        $limitBreak = floor($quantity/$discountRules->limit);
        $discountQuantity = $limitBreak * $discountRules->value;
        $newQuantity = $quantity + $discountQuantity;
        return	$newQuantity;
    }


    public function applyDiscountByModifyingPrice($total, $discountRules)
    {
        $discountQuantity = ($total*$discountRules->value)/100;
        $newTotal = $total - $discountQuantity;
        return	$newTotal;
    }
}
