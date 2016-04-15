<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetOpenDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_open_days', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
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
        Schema::drop('set_open_days');
    }
}
