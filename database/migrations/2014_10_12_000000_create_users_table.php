<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('user_id');
            $table->unsignedInteger('user_create')->nullable();
            $table->tinyInteger('role');
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('email');
            $table->string('password', 255);
            $table->string('address')->nullable();
            $table->string('phone', 60);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
