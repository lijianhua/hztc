<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewMaterialsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('review_materials', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('enterprise_id')->unsigned()->index();
      $table->string('name');
      $table->string('note');
      $table->string('image_url', 1024);
      $table->boolean('is_text');
      $table->boolean('is_image');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('review_materials');
  }

}
