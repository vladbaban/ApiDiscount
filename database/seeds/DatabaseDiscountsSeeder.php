<?php

use Illuminate\Database\Seeder;

class DatabaseDiscountsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('Discounts')->insert([
       		
       		'Description' =>'OrderPercent',
       		'Type'=>'percent',
       		'DiscountAplicationRules'=>'Select *',
       		'DiscountValues'=>'10',
       	]);

        DB::table('Discounts')->insert([
       		
       		'Description' =>'QuantityOfProduct',
       		'Type'=>'quantity',
       		'DiscountAplicationRules'=>'Select * where type="1"',
       		'DiscountValues'=>'5',
       	]);
    }
}
