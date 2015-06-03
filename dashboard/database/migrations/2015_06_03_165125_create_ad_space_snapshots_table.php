<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdSpaceSnapshotsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ad_space_snapshots', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('ad_space_id')->unsigned()->index();
      $table->integer('ad_category_id')->unsigned()->index();
      $table->string('title');
      $table->string('description', 1024)->nullable();
      $table->text('detail');
      /**
       * 表示广告位类型
       * 0 => 正常
       * 1 => 免费
       * 2 => 特价
       * 3 => 众筹
       * */
      $table->tinyInteger('type')->default(0);
      $table->smallInteger('version')->default(1);
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
    Schema::drop('ad_space_snapshots');
  }

}
