<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiscountServices\DiscoutDependantOnQuantityAndCategory_AddingToQuantityEfect;

class CalculateDiscountController extends Controller
{
    

 public function calculateDiscounts(Request $request)
    {
    $discount = new DiscoutDependantOnQuantityAndCategory_AddingToQuantityEfect();
    $order= $request->all();
    
    return $discount->compute($order);

    }

}
