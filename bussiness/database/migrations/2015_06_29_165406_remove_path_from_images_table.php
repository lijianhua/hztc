<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePathFromImagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('images', function (Blueprint $table) {
      $table->dropColumn('path');
      $table->dropColumn('note');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('images', function (Blueprint $table) {
      $table->string('path', 1024);
      $table->string('note', 1024);
    });
  }
}
