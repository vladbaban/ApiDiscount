<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountRule extends Model
{	
	//table name
	 protected $fillable = ['description','value','limit','percentage', 'category'];

}
