<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $e = factory('App\Models\Enterprise', 'root')->create();
    $e->users()->save(factory('App\Models\User', 'root')->make());
  }
}
