<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DelColImageUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_materials', function (Blueprint $table) {
            //
          $table->dropColumn('image_url'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_materials', function (Blueprint $table) {
            //
          $table->string('image_url', 1024);
        });
    }
}
