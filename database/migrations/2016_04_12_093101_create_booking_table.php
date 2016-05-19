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
            $table->integer('player_id');
            $table->integer('payment_id')->unsigned();
            $table->enum('status', ['required', 'paid'])->default('required');
            $table->enum('status_booking', ['create', 'update','cancel'])->default('create');
            $table->date('date');
            $table->text('info_contract');
            $table->integer('day_of_week')->nullable();
            $table->integer('court_id')->unsigned();
            $table->text('extra_id')->nullable();
            $table->boolean('is_member');
            $table->integer('teacher_id')->nullable();
            $table->double('price_teacher')->nullable();
            $table->double('total_price')->nullable();
            $table->float('hour');
            $table->tinyInteger('hour_length');
            $table->tinyInteger('num_player')->nullable();
            $table->text('player_info');
            $table->text('billing_info');
            $table->text('payment_info');
            $table->string('booked_by',255);
            $table->tinyInteger('source')->comment()->default('1');
            $table->text('notes');
            $table->foreign('court_id')
                ->references('id')
                ->on('courts')
                ->onDelete('cascade');

            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
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
