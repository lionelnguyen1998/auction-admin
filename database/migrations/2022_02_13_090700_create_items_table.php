<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('auction_id');
            $table->unsignedInteger('selling_user_id');
            $table->unsignedInteger('buying_user_id')->nullable();
            $table->unsignedInteger('brand_id')->nullable();
            $table->string('series', 10)->nullable();
            $table->string('name', 255);
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
        Schema::dropIfExists('items');
    }
}
