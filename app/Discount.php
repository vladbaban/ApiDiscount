<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{	
	
	//table name
	 protected $fillable = ['description','value','limit','percentage'];
     
}
