<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('promotions', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('ad_space_id')->unsigned()->index();
      $table->string('title');
      $table->integer('stock');
      $table->decimal('price', 10, 3);
      $table->timestamp('start');
      $table->timestamp('end');
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
    Schema::drop('promotions');
  }
}
