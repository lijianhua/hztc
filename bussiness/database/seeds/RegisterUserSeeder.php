<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RegisterUserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();

    factory('App\Models\User', 10)->create();
  }
}
