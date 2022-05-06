<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReadNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_read_news', function (Blueprint $table) {
            $table->increments('user_read_new_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('new_id')->nullable();
            $table->unsignedInteger('auction_id')->nullable();
            $table->tinyInteger('is_read');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_read_news');
    }
}
