<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\AdSpace;

class OrderSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory('App\Models\Order', 100)
      ->create([
        'user_id'     => User::first()->id,
      ])
      ->each(function ($order) {
        $order->orderItems()->save(factory('App\Models\OrderItem')->make([
          'ad_space_id' => AdSpace::first()->id
        ]));
      });
  }
}
