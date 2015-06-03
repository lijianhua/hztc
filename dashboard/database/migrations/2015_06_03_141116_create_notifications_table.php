<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('notifications', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->index();
      $table->string('message', 1024);
      $table->boolean('is_read');
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
    Schema::drop('notifications');
  }

}
