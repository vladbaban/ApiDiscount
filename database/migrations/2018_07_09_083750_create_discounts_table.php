<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	//defining the table structure
	public function up() {
		Schema::create('discount_rules', function (Blueprint $table) {
			$table->increments('id');
			$table->string('description');
			$table->integer('value');
			$table->float('limit')->nullable();
			$table->integer('category')->nullable();
			$table->boolean('percentage')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('discount_rules');
	}
}
