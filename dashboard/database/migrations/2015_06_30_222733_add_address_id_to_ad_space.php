<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressIdToAdSpace extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('ad_spaces', function (Blueprint $table) {
      $table->integer('address_id')->unsigned()->index();
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
      $table->dropColumn('address_id');
    });
  }
}
