<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeAvailablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_unavailables', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('court_id')->unsigned();
            $table->float('hour');
            $table->float('hour_length');
            $table->string('reason', 100);

            $table->foreign('court_id')
                ->references('id')
                ->on('courts')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('time_unavailables');
    }
}
