<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnPictureFromAdSpaces extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('ad_spaces', function (Blueprint $table) {
      $table->dropColumn('picture');
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
      $table->string('picture', 1024);
    });
  }
}
