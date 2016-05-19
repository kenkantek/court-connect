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
			$table->decimal('amount');
			$table->string('stripe_transaction_id');
			$table->string('card_number', 20);
			$table->tinyInteger('exp_month')->unsigned();
			$table->tinyInteger('exp_year')->unsigned();
			$table->tinyInteger('cvv')->unsigned();
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
