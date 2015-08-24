<?php

use Illuminate\Database\Seeder;

class PendingEnterpriseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory('App\Models\Enterprise', 10)->create();
  }
}
