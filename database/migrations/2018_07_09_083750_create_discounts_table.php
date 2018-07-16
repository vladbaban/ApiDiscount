<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //defining the table structure
    public function up()
    {
        Schema::create('discounts', function(Blueprint $table) {
                $table->increments('id');
                $table->string('description');
                $table->integer('value');
                $table->float('limit');
                $table->boolean('percentage');
                $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('discounts');
    }
}
