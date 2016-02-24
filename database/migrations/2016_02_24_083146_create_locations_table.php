<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('locations', function (Blueprint $table) {
			$table->increments('id');
			$table->string('city', 20);
			$table->string('state_code', 2);
			$table->string('state', 60);
			$table->string('zipcode', 5);
			$table->decimal('latitude', 10);
			$table->decimal('longitude', 10);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('locations');
	}
}
