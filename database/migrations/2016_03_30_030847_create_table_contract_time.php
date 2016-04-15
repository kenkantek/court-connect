<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContractTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts_club', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('note');
            $table->integer('club_id')->unsigned();
            $table->boolean('is_member')->default(true);
            $table->text('extras')->nullable();
            $table->integer('total_week')->unsigned();
            $table->integer('user_id')->unsigned()->references('id')
                ->on('users');
            $table->text('rates');

            $table->foreign('club_id')
                ->references('id')
                ->on('clubs')
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
        Schema::drop('contracts_club');
    }
}
