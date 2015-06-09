<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerReviewsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('customer_reviews', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->index();
      $table->integer('order_id')->unsigned()->index();
      $table->integer('ad_space_id')->unsigned()->index();
      /**
       * 评分：-1 0 1
       */
      $table->tinyInteger('score');
      $table->text('body');
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
    Schema::drop('customer_reviews');
  }

}
