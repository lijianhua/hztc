<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdPricesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ad_prices', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('ad_space_id')->unsigned()->index();
      $table->decimal('original_price', 10, 3)->nullable();
      $table->decimal('price', 10, 3);
      $table->date('from');
      $table->date('to');
      // 发送次数
      $table->integer('send_count')->unsigned()->default(1);
      // 每天销售次数
      $table->integer('sale_count')->unsigned()->default(1);
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
    Schema::drop('ad_prices');
  }

}
