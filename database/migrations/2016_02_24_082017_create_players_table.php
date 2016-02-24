<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('players', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->references('id')
				->on('users')
				->onDelete('cascade');
			$table->tinyInteger('receive_discount_offers');
			$table->integer('tenis_level')->unsigned();
			$table->tinyInteger('is_recive_notification')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('players');
	}
}
