<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrowdFundingAdImagePivotTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('crowd_funding_ad_image', function(Blueprint $table) {
      $table->integer('crowd_funding_ad_id')->unsigned()->index();
      $table->foreign('crowd_funding_ad_id')->references('id')->on('crowd_funding_ads')->onDelete('cascade');
      $table->integer('image_id')->unsigned()->index();
      $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
      $table->tinyInteger('stage');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('crowd_funding_ad_image');
  }
}
