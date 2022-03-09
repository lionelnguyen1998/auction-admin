<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuctionDenyIdOfUserReadNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_read_news', function (Blueprint $table) {
            $table->unsignedInteger('auction_deny_id')->nullable()->after('new_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_read_news', function (Blueprint $table) {
            $table->dropColumn('auction_deny_id');
        });
    }
}
