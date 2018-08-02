<?php

namespace App\Providers;

use App\DatabaseRulesManager;
use App\Services\Discounts\DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount;
use App\Services\Discounts\DiscountImplementationReceivePriceReductionForCheapestProductOutOfTwoOrMoreItems;
use App\Services\Discounts\DiscountImplementationReceiveTotalOrderPriceReductionForClientsWithPreviousOrdersValueOverThreshold;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		// eliminates the data wraping when resourse responds
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//here we create bindins between the discount descriptions and the discount classes
		app()->singleton('DiscountReceiveFreeProductWhenBuyingMoreThanThresholdAmount', function () {
			return new DiscountImplementationReceiveFreeProductWhenBuyingMoreThanThresholdAmount(new DatabaseRulesManager());
		});
		app()->singleton('DiscountReceivePriceReductionForCheapestProductOutOfTwoOrMoreItemsOfACertainCategory', function () {
			return new DiscountImplementationReceivePriceReductionForCheapestProductOutOfTwoOrMoreItems(new DatabaseRulesManager());
		});
		app()->singleton('DiscountReceiveTotalOrderPriceReductionForClientsWithPreviousOrdersValueOverThreshold', function () {
			return new DiscountImplementationReceiveTotalOrderPriceReductionForClientsWithPreviousOrdersValueOverThreshold(new DatabaseRulesManager());
		});
	}
}
