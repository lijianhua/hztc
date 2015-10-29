<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DelColAttractionRateToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_spaces', function (Blueprint $table) {
            //
          $table->dropColumn('attraction_rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_spaces', function (Blueprint $table) {
            //
          $table->tinyInteger('attraction_rate')->nullable();
        });
    }
}
