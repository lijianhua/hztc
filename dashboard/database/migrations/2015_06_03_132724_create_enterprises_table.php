<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterprisesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('enterprises', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('name');
      // 企业行业
      $table->string('trade');
      $table->string('qq', 40)->nullable();
      $table->string('weixin')->nullable();
      $table->string('telphone', 40)->nullable();
      $table->string('phone', 40)->nullable();
      $table->string('logo_image')->nullable();
      // 是否通过审核
      $table->boolean('is_audited')->default(false);
      // 是否通过认证
      $table->boolean('is_verify')->default(false);
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
    Schema::drop('enterprises');
  }

}
