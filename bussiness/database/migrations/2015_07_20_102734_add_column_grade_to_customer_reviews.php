<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnGradeToCustomerReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_reviews', function (Blueprint $table) {
            //
            $table->integer('grade');
            $table ->dropColumn('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_reviews', function (Blueprint $table) {
            //
              $table ->dropColumn('grade');
        });
    }
}
