<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 30)->unique();
            $table->string('email', 60)->unique();
            $table->string('password', 60);
            $table->string('phone', 15);
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('zip_code', 6);
            $table->string('facebook', 120);
            $table->string('google', 120);
            $table->tinyInteger('gender');
            $table->string('avatar')->default('uploads/images/users/no-avatar.png');
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
