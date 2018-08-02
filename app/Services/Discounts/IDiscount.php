<?php

namespace App\Services\Discounts;

use App\DatabaseRulesManager;
use App\DiscountRule;

interface IDiscount {
	public function __construct(DatabaseRulesManager $databaseRulesManager);
	public function compute(array $orderInput, DiscountRule $rule);
}
