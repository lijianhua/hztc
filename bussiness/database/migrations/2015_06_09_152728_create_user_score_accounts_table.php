<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserScoreAccountsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_score_accounts', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->index();
      $table->integer('total_score');
      /**
       * 积分账户状态
       *
       * 0 => 停用
       * 1 => 启用
       */
      $table->boolean('state');
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
    Schema::drop('user_score_accounts');
  }

}
