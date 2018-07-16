<?php

use Illuminate\Database\Seeder;
use App\Discount;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Discount::create([
       		
       		'description' =>'OrderPercent',
       		'percentage'=>true,       		
       		'value'=>'10',
          'limit'=>'1000'
       	]);

        Discount::create([
       		
       		'description' =>'QuantityOfProduct',
       		'percentage'=>false,
          'value'=>'5',
          'limit'=>'5'
       	]);
    }
}
