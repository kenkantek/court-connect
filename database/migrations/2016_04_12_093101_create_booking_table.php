<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['open', 'contract','lesson']);
            $table->enum('status', ['required', 'paid'])->default('required');
            $table->date('date');
            $table->string('date_range')->nullable();
            $table->integer('day_of_week')->nullable();
            $table->integer('court_id')->unsigned();
            $table->text('extra_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->boolean('is_member');
            $table->double('total_price')->nullable();
            $table->float('hour');
            $table->tinyInteger('hour_length');
            $table->tinyInteger('num_player')->nullable();
            $table->integer('player_id');
            $table->text('user_info');
            $table->text('payment_info');

            $table->foreign('court_id')
                ->references('id')
                ->on('courts')
                ->onDelete('cascade');

            $table->foreign('player_id')
                ->references('id')
                ->on('players')
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
        Schema::drop('bookings');
    }
}