<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPositionToAdPrices extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('ad_prices', function (Blueprint $table) {
      $table->string('position');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('ad_prices', function (Blueprint $table) {
      $table->dropColumn('position');
    });
  }
}
