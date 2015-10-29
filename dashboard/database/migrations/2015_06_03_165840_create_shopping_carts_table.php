<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingCartsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('shopping_carts', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->index();
      $table->integer('ad_space_id')->unsigned()->index();
      $table->integer('ad_space_snapshot_id')->unsigned()->index();
      $table->integer('quantity');
      $table->date('from');
      $table->date('to');
      $table->decimal('original_price', 10, 3);
      $table->decimal('price', 10, 3);
      $table->decimal('subtotal', 10, 3);
      $table->boolean('is_validate')->default(true);
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
    Schema::drop('shopping_carts');
  }

}
