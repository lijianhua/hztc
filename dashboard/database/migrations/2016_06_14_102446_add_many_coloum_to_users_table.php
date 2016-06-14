<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddManyColoumToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->string('user_type');
            $table->string('user_code', 6);
            $table->string('progress'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
            $table->dropColumn('user_type');
            $table->dropColumn('user_code');
            $table->dropColumn('progress');
        });
    }
}
