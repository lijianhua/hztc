<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->index();
      $table->integer('ad_space_id')->unsigned()->index();
      $table->integer('ad_space_snapshot_id')->unsigned()->index();
      $table->string('order_seq', 45);
      $table->date('from');
      $table->date('to');
      $table->decimal('original_price', 10, 3);
      $table->decimal('price', 10, 3);
      $table->decimal('subtotal', 10, 3);
      /**
       * 订单状态
       * 0 => 未付款
       * 1 => 已付款
       * 2 => 已执行
       * 3 => 完成交易
       **/
      $table->tinyInteger('state');
      $table->timestamp('paid_at');
      $table->softDeletes();
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
    Schema::drop('orders');
  }

}
