<?php use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class AlterTableAddPrices extends Migration { /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_prices', function (Blueprint $table) {
          
            $table ->double('price',10,3);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_prices', function (Blueprint $table) {
            //
            $table ->dropColumn('price');
        });
    }
}
