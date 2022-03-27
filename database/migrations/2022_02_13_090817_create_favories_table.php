<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favories', function (Blueprint $table) {
            $table->increments('favorite_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('auction_id')->nullable();
            $table->tinyInteger('is_liked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favories');
    }
}
