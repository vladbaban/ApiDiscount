<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
        	'id'=>'A101',
        	'description'=>'Screwdriver',
        	'category'=>'1',
        	'price'=>'9.75',
        	]);
        Product::create([
        	'id'=>'A102',
        	'description'=>'Electric screwdriver',
        	'category'=>'1',
        	'price'=>'49.50',
        	]);
        Product::create([
        	'id'=>'B101',
        	'description'=>'Basic on-off switch',
        	'category'=>'2',
        	'price'=>'4.99',
        	]);
        Product::create([
        	'id'=>'B102',
        	'description'=>'Press button',
        	'category'=>'2',
        	'price'=>'4.99',
        	]);
        Product::create([
        	'id'=>'B103',
        	'description'=>'Switch with motion detector',
        	'category'=>'2',
        	'price'=>'12.95',
        	]);
    }
}
