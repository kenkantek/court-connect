<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('payments', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->references('id')->on('users');
			$table->string('first_name', 30);
			$table->string('last_name', 30);
			$table->string('zip_code', 5);
			$table->integer('payment_type')->unsigned();
			$table->string('card_number', 20);
			$table->tinyInteger('expiration_month')->unsigned();
			$table->tinyInteger('expiration_year')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('payments');
	}
}
