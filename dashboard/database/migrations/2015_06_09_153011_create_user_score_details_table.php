<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserScoreDetailsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_score_details', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_score_account_id')->unsigned()->index();
      $table->integer('score');
      $table->string('reason', 1024);
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
    Schema::drop('user_score_details');
  }

}
