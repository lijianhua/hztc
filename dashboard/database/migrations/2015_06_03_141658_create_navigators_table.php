<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigatorsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('navigators', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('name');
      $table->string('url');
      // 表示是否启用
      $table->boolean('state');
      $table->integer('sort')->unsigned();
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
    Schema::drop('navigators');
  }

}
