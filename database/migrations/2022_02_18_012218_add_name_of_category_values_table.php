<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameOfCategoryValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_values', function (Blueprint $table) {
            $table->string('name_en', 100)->nullable()->after('type');
            $table->string('name', 100)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_values', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('name_en');
        });
    }
}
