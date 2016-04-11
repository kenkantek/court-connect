<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubCourtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('court_rate_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('date_club_id')->unsigned();
            $table->integer('court_id')->unsigned();
            $table->integer('court_rate_id')->unsigned();
            $table->text('list_hour');
            $table->foreign('date_club_id')
                ->references('id')
                ->on('date_club')
                ->onDelete('cascade');

            $table->foreign('court_id')
                ->references('id')
                ->on('courts')
                ->onDelete('cascade');

            $table->foreign('court_rate_id')
                ->references('id')
                ->on('court_rate')
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
        Schema::drop('court_rate_details');
    }
}
