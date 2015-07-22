<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideItemsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('slide_items', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('slide_id')->unsigned()->index();
      $table->string('picture', 1024);
      $table->string('url', 1024)->nullable();
      $table->string('note', 1024)->nullable();
      $table->smallInteger('sort')->default(0);
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
    Schema::drop('slide_items');
  }

}
