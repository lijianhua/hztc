<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnitAndNoteToAdPrices extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('ad_prices', function (Blueprint $table) {
      $table->string('unit')->nullable();
      $table->string('note')->nullable();
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
      $table->dropColumn(['unit', 'note']);
    });
  }
}
