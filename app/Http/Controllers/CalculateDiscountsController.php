<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\UploadedFile;
//use Illuminate\Support\Facades\Storage;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithoutMiddleware;

class CalculateDiscountsController extends Controller
{

	function showMessage()
	{
		$response = $this->get('discounts/show');

         $response
            ->assertStatus(201)
            ->assertExactJson([
                'created' => true,
            ]);
            return $response;

	}
    

    function calculateDiscounts(){

    }
}
