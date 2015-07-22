<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;
use App\Models\Refund;

class RefundSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();

    for ($i = 0; $i < 10; $i++) {
      $order = Order::offset($i)->first();

      Refund::create([
        'order_seq' => $order->order_seq,
        'user_id'   => $order->user_id,
        'state'     => $i % 2,
        'order_id'  => $order->id,
        'confirmed' => false,
        'apply_at'  => new Carbon()
      ]);
    }
  }
}
