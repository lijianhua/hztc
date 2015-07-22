<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdSpacesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ad_spaces', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->index();
      $table->string('title');
      $table->string('picture', 1024);
      $table->string('description', 1024);
      $table->string('street_address', 1024);
      $table->text('detail')->nullable();
      /**
       * 表示广告位类型
       * 0 => 正常
       * 1 => 免费
       * 2 => 特价
       * 3 => 众筹
       * */
      $table->tinyInteger('type')->default(0);
      $table->smallInteger('version')->default(1);
      $table->integer('sort')->default(0);
      // 广告位使用软删除，这段语句会生成一个'deleted_at'的字段`
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
    Schema::drop('ad_spaces');
  }

}
