<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

	/**
	 * Run the user seeds.
	 *
	 * @return void
	 */
	public function run() {
		User::truncate();

		User::create([
			'name' => 'Coca Cola',
			'revenue' => '492.12',
		]);
		User::create([
			'name' => 'Teamleader',
			'revenue' => '1505.95',
		]);
		User::create([
			'name' => 'Jeroen De Wit',
			'revenue' => '0.00',
		]);
	}
}
