<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 60)->unique();
            $table->string('password', 60);
            $table->string('phone', 15);
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->tinyInteger('gender');
            $table->string('address1', 255);
            $table->string('address2', 255);
            $table->string('state', 100);
            $table->string('city', 100);
            $table->string('zip_code', 6);
//            $table->integer('skill_level')->unsigned();
//            $table->foreign('role_id')
//                ->references('id')
//                ->on('roles')
//                ->onDelete('cascade');
            $table->string('google_id', 120);
            $table->string('facebook_id')->nullable();
            $table->string('avatar')->default('no-avatar.png');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
