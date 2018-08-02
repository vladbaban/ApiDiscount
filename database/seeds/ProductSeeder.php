<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {

	/**
	 * Run the product seeds.
	 *
	 * @return void
	 */
	public function run() {
		Product::truncate();

		Product::create([
			'productId' => 'A101',
			'description' => 'Screwdriver',
			'category' => '1',
			'price' => '9.75',
		]);
		Product::create([
			'productId' => 'A102',
			'description' => 'Electric screwdriver',
			'category' => '1',
			'price' => '49.50',
		]);
		Product::create([
			'productId' => 'B101',
			'description' => 'Basic on-off switch',
			'category' => '2',
			'price' => '4.99',
		]);
		Product::create([
			'productId' => 'B102',
			'description' => 'Press button',
			'category' => '2',
			'price' => '4.99',
		]);
		Product::create([
			'productId' => 'B103',
			'description' => 'Switch with motion detector',
			'category' => '2',
			'price' => '12.95',
		]);
	}
}
