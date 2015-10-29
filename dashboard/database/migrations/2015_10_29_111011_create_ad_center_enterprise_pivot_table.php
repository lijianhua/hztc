<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdCenterEnterprisePivotTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ad_center_enterprise', function(Blueprint $table) {
      $table->integer('ad_center_id')->unsigned()->index();
      $table->foreign('ad_center_id')->references('id')->on('ad_centers')->onDelete('cascade');
      $table->integer('enterprise_id')->unsigned()->index();
      $table->foreign('enterprise_id')->references('id')->on('enterprises')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('ad_center_enterprise');
  }
}
