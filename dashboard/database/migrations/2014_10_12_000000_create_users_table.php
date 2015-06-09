<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('enterprise_id')->unsigned()->index()->nullable();
      $table->string('name');
      $table->string('email')->unique();
      $table->string('password', 60);
      $table->string('picture', 1024)->nullable();
      // 是否邮箱确认
      $table->boolean('confirmed');
      // 是否通过认证
      $table->boolean('is_verify');
      $table->rememberToken();
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
    Schema::drop('users');
  }

}
