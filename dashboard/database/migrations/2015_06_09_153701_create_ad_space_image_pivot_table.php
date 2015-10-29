<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdSpaceImagePivotTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ad_space_image', function(Blueprint $table) {
      $table->integer('ad_space_id')->unsigned()->index();
      $table->foreign('ad_space_id')->references('id')->on('ad_spaces')->onDelete('cascade');
      $table->integer('image_id')->unsigned()->index();
      $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('ad_space_image');
  }
}
