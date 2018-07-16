<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('discounts/{Description}',function($Description){
//		return "you are a you are a ".$Description;
//
//});


Route::get('discounts/show','CalculateDiscountController@calculateDiscounts');

//route::get('discounts/json', function(){
//$Order = \App\OrderModel::get()->toJson();
//return compact('$Order');
//});