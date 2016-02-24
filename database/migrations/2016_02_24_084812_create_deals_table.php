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
			$table->integer('user_id')->unsigned()->references('id')->on('users');
			$table->integer('player_id')->unsigned()->references('id')->on('players');
			$table->integer('court_id')->unsigned()->references('id')->on('court');
			$table->decimal('price')->unsigned();
			$table->string('time', 30);
			$table->integer('payment_id')->unsigned();
			$table->tinyinteger('status')->unsigned();
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
