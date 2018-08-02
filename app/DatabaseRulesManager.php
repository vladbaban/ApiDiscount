<?php

namespace App;

use App\Product;
use App\User;

class DatabaseRulesManager {

	/**
	 * This function gets all products in the local DB
	 * @return collection
	 */
	public function getAllProducts() {
		return Product::all();
	}

	/**
	 * Gets products within a certain category
	 * @param  string $discountCategory
	 * @return collection
	 */
	public function getProductsByCategory(string $discountCategory) {
		return Product::where('category', $discountCategory)->get();
	}

	/**
	 * gets the user by his id
	 * @param  string $customer_id
	 * @return User
	 */
	public function getUserById(string $customer_id) {
		return User::where('id', $customer_id)->first();

	}
}
