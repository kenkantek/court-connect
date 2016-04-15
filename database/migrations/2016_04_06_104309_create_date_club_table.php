<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDateClubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_club', function (Blueprint $table) {
            $table->increments('id');
            $table->char('date');
            $table->char('open_time');
            $table->char('close_time');
            $table->boolean('is_holiday')->default(false);
            $table->boolean('is_close')->default(false);
            $table->integer('club_id')->unsigned();

            $table->foreign('club_id')
                ->references('id')
                ->on('clubs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('date_club');
    }
}
