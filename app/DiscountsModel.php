<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountsModel extends Model
{	use Notifiable;
	
	//table name
	 protected $table = 'Description','Type','DiscountAplicationRules','DiscountValues';
     
}
