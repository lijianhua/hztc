<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuditedToAdSpaces extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('ad_spaces', function (Blueprint $table) {
      $table->boolean('audited');
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
      $table->dropColumn('audited');
    });
  }
}
