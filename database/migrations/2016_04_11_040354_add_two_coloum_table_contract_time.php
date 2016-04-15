<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoColoumTableContractTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts_club', function (Blueprint $table) {
            $table->integer('total_week')->unsigned();
            $table->integer('user_id')->unsigned()->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts_club', function (Blueprint $table) {
            //
        });
    }
}
