<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdCentersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ad_centers', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->unique();
      $table->string('avatar_file_name')->nullable();
      $table->integer('avatar_file_size')->nullable();
      $table->string('avatar_content_type')->nullable();
      $table->timestamp('avatar_updated_at')->nullable();
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
    Schema::drop('ad_centers');
  }
}
