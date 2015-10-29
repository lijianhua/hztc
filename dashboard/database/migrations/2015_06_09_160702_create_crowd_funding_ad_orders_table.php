<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrowdFundingAdOrdersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('crowd_funding_ad_orders', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->index();
      $table->integer('crowd_funding_ad_id')->unsigned()->index();
      $table->decimal('price', 10, 3);
      $table->string('bonus', 1024);
      /**
       * 订单状态
       * 0 => 未付款
       * 1 => 已付款
       * 2 => 已执行
       * 3 => 客户确认完毕
       */
      $table->tinyInteger('state');
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
    Schema::drop('crowd_funding_ad_orders');
  }

}
