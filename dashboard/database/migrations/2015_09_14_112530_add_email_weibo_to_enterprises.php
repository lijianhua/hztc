<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailWeiboToEnterprises extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('enterprises', function (Blueprint $table) {
      // 存放企业邮箱资料
      $table->string('email');
      // 微博
      $table->string('weibo');
      // 商家详情
      $table->text('detail');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('enterprises', function (Blueprint $table) {
      $table->dropColumn(['email', 'weibo', 'detail']);
    });
  }
}
