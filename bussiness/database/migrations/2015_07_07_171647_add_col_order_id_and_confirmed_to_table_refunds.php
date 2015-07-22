<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColOrderIdAndConfirmedToTableRefunds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('refunds', function (Blueprint $table) {
            //
            $table->Integer('order_id')->unsigned()->index();
            /**
            * 审核状态
            * 0 => 未通过
            * 1 => 通过
            **/
            $table->tinyInteger('confirmed');
            $table->index(['order_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('refunds', function (Blueprint $table) {
            //
            $table ->dropColumn('order_id');
            $table ->dropColumn('confirmed');
        });
    }
}
