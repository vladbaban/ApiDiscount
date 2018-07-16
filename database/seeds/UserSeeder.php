<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name'=>'Coca Cola',
        	'revenue'=>'492.12',
        	]);
         User::create([
        	'name'=>'Teamleader',
        	'revenue'=>'1505.95',
        	]);
         User::create([
        	'name'=>'Jeroen De Wit',
        	'revenue'=>'0.00',
        	]); 
    }
}
