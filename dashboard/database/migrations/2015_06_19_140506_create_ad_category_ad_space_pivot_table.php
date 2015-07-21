<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdCategoryAdSpacePivotTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ad_category_ad_space', function(Blueprint $table) {
      $table->integer('ad_category_id')->unsigned()->index();
      $table->foreign('ad_category_id')->references('id')->on('ad_categories')->onDelete('cascade');
      $table->integer('ad_space_id')->unsigned()->index();
      $table->foreign('ad_space_id')->references('id')->on('ad_spaces')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('ad_category_ad_space');
  }
}
