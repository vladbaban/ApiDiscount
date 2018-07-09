<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAndEditDiscountsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //defining the table structure
    public function up()
    {
        Schema::create('Discounts', function(Blueprint $table) {
                $table->increments('Id');
                $table->string('Description');
                $table->string('Type');
                $table->string('DiscountAplicationRules');
                $table->integer('DiscountValues');
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
         Schema::dropIfExists('Discounts');
    }
}
