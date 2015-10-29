<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdSaleCalendarsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ad_sale_calendars', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('ad_space_id')->unsigned()->index();
      $table->date('from');
      $table->date('to');
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
    Schema::drop('ad_sale_calendars');
  }

}
