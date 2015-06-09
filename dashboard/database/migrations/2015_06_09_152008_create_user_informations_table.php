<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInformationsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_informations', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->index();
      $table->string('key');
      $table->string('value');
      /**
       * 表示权限
       * R 只读
       * A 读/写
       **/
      $table->char('authority', 1);
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
    Schema::drop('user_informations');
  }

}
