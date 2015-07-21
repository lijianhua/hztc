<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColApplyAtToRefundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('refunds', function(Blueprint $table)
		{
			//
            $table->timestamp('apply_at')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('refunds', function(Blueprint $table)
		{
			//
      $table ->dropColumn('apply_at');
		});
	}

}
