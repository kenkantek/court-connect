<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDealsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('deals', function (Blueprint $table) {
			$table->increments('id');
			$table->date('date');
			$table->integer('court_id')->unsigned();
			$table->float('hour');
			$table->float('hour_length');
			$table->float('price_member');
			$table->float('price_nonmember');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('deals');
	}
}
