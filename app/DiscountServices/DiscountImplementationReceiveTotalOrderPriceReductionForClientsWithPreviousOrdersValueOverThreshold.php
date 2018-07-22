<?php

namespace App\DiscountServices;

use App\DiscountRule;
use App\User;
use Illuminate\Support\Facades\DB;
use App\DiscountServices\DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount;

class DiscountImplementationReceiveTotalOrderPriceReductionForClientsWithPreviousOrdersValueOverThreshold implements IDiscount
{
    public function compute($orderInput, $description)
    {
        $orederDiscount = [];
        $discountRules =DiscountRule::where('description', $description)->first();
        $discountFreeProduct = new DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount();
        $user=User::select('name')->where('id', $orderInput["customer-id"])->first();
        $newTotalOrderPrice =round($discountFreeProduct->applyDiscountByModifyingPrice($orderInput["total"], $discountRules), 3);
        return $orderDiscount[]=
        [
        'client'=>$orderInput["customer-id"],
        'client-name'=>$user["name"],
        'discountValues'=>$discountRules["value"]."%",
        'newTotalOrderPrice'=> $newTotalOrderPrice
        ];
    }
}