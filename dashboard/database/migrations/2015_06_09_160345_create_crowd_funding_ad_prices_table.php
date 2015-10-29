<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrowdFundingAdPricesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('crowd_funding_ad_prices', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('crowd_funding_ad_id')->unsigned()->index();
      $table->decimal('price', 10, 3);
      $table->string('bonus', 1024);
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
    Schema::drop('crowd_funding_ad_prices');
  }

}
