<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrowdFundingAdsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('crowd_funding_ads', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->index();
      $table->integer('ad_space_id')->unsigned()->index();
      $table->string('title');
      $table->string('description', 1024);
      $table->text('detail');
      $table->decimal('target_funding', 10, 3);
      $table->integer('days')->unsigned();
      /**
       * 众筹阶段
       * 0 => 预热
       * 1 => 进程中
       * 2 => 结束
       */
      $table->tinyInteger('stage');
      // 是否达成目标
      $table->boolean('is_goal');
      // 是否通过审核
      $table->boolean('is_audit');
      $table->date('started_at');
      $table->date('ended_at');
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
    Schema::drop('crowd_funding_ads');
  }

}
