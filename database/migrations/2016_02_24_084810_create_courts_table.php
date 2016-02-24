<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourtsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('courts', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('club_id')->unsigned()->references('id')
				->on('clubs');
			$table->string('opening_time', 50);
			$table->string('closing_time', 50);
			$table->string('opening_day', 50);
			$table->decimal('member_price')->unsigned();
			$table->decimal('non_member_price')->unsigned();
			$table->tinyinteger('indoor_outdoor');
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
		Schema::drop('courts');
	}
}
