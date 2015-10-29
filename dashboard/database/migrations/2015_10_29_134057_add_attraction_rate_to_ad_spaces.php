<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttractionRateToAdSpaces extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('ad_spaces', function (Blueprint $table) {
      // From 1 to 5
      $table->tinyInteger('attraction_rate')->nullable();
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
      $table->dropColumn('attraction_rate');
    });
  }
}
