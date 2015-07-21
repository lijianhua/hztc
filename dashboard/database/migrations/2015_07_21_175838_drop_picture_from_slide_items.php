<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPictureFromSlideItems extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('slide_items', function (Blueprint $table) {
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
    Schema::table('slide_items', function (Blueprint $table) {
      $table->string('picture', 1024);
    });
  }
}
