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
      $table->string('order_seq', 45)->unique();
      /**
       * 订单状态
       * 0 => 未付款
       * 1 => 已付款
       * 2 => 已执行
       * 3 => 完成交易
       * 4 => 用户已取消
       **/
      $table->tinyInteger('state');
      $table->timestamp('paid_at')->nullable();
      $table->softDeletes();
      $table->timestamps();
    });

    Schema::create('order_items', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('ad_space_id')->unsigned()->index();
      $table->integer('order_id')->unsigned()->index();
      $table->integer('ad_space_snapshot_id')->unsigned()->index()->nullable();
      $table->date('from');
      $table->date('to');
      $table->decimal('original_price', 10, 3);
      $table->decimal('price', 10, 3);
      $table->decimal('subtotal', 10, 3);
      $table->integer('score');
      $table->integer('quantity');
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
    Schema::drop(['orders', 'order_items']);
  }

}
