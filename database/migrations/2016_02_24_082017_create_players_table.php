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
			$table->string('username', 30)->unique();
			$table->string('email', 60)->unique();
			$table->string('password', 60);
			$table->string('phone', 15);
			$table->string('first_name', 30);
			$table->string('last_name', 30);
			$table->string('state', 100);
			$table->string('city', 100);
			$table->string('zip_code', 6);
			$table->string('address1', 255);
			$table->string('address2', 255);
			$table->string('surname', 100);
			$table->string('facebook', 120);
			$table->string('google', 120);
			$table->tinyInteger('gender');
			$table->string('facebook_id')->nullable();
			$table->string('avatar')->default('uploads/images/users/no-avatar.png');
			$table->tinyInteger('receive_discount_offers');
			$table->integer('tenis_level')->unsigned();
			$table->tinyInteger('is_recive_notification')->unsigned();
			$table->rememberToken();
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
