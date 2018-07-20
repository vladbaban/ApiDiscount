<?php

namespace App\Providers;
use App\DiscountServices\DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount;
use App\DiscountServices\DiscountImplementationReceivePriceReductionForCheepestProductOutOfTwoOrMoreItems;
use App\DiscountServices\DiscountImplementationReceiveTotalOrderPriceReductionForClientsWithPreviosOrdersValueOverThreshold;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // eliminates the data wraping when resourse responds
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        app()->singleton('DiscountReceiveFreeProductWhenBuyingMoreThanThresholdAmount',function(){
            return new DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount();
        });
        app()->singleton('DiscountReceivePriceReductionForCheepestProductOutOfTwoOrMoreItemsOfACertainCategory',function(){
            return new DiscountImplementationReceivePriceReductionForCheepestProductOutOfTwoOrMoreItems();
        });
        app()->singleton('DiscountReceiveTotalOrderPriceReductionForClientsWithPreviosOrdersValueOverThreshold',function(){
            return new DiscountImplementationReceiveTotalOrderPriceReductionForClientsWithPreviosOrdersValueOverThreshold();
        });
     
     
    }
}
