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
            // here we check if the discount is applied to all items or to a category
        if (is_null($discountRules->category)) {
            $products = DB::table('products')->all();
        } else {
            $products =DB::table('products')->where('category', $discountRules->category)->get();
        }
        $itemsToApplyDiscount= $this->getItemsByCategory($orderInput, $products);
        $Discounts= $this->calculateDiscountsForItems($itemsToApplyDiscount, $discountRules);
        return $Discounts;
    }

    // here we decide witch result structure to use for the current discount and item
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
    

//if a discount is applyed to a certain category we can use this function to return all items of that category
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

// calculates the discout if it adds to quantitiy
    public function applyDiscountByAddingToQuantity($quantity, $discountRules)
    {
        $limitBreak = floor($quantity/$discountRules->limit);
        $discountQuantity = $limitBreak * $discountRules->value;
        $newQuantity = $quantity + $discountQuantity;
        return	$newQuantity;
    }

// this fucntion calculates discounts if it reduces total price by a percent
    public function applyDiscountByModifyingPrice($total, $discountRules)
    {
        $discountQuantity = ($total*$discountRules->value)/100;
        $newTotal = $total - $discountQuantity;
        return	$newTotal;
    }
}
