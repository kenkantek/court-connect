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
			$table->integer('user_id')->unsigned();
			$table->string('surname', 100);
<<<<<<< .mine








=======
			$table->string('facebook', 120);
			$table->string('google', 120);
			$table->string('country')->nullable();
      $table->float('longitude')->nullable();
      $table->float('latitude')->nullable();
			$table->tinyInteger('gender');
			$table->string('facebook_id')->nullable();
			$table->string('avatar')->default('uploads/images/users/no-avatar.png');
>>>>>>> .theirs
			$table->tinyInteger('receive_discount_offers');
			$table->integer('tenis_level')->unsigned();
			$table->tinyInteger('is_recive_notification')->unsigned();
			$table->rememberToken();
			$table->timestamps();

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
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
