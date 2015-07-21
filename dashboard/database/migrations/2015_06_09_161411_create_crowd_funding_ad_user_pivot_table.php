<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrowdFundingAdUserPivotTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('crowd_funding_ad_user', function(Blueprint $table) {
      $table->integer('crowd_funding_ad_id')->unsigned()->index();
      $table->foreign('crowd_funding_ad_id')->references('id')->on('crowd_funding_ads')->onDelete('cascade');
      $table->integer('user_id')->unsigned()->index();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('crowd_funding_ad_user');
  }
}
