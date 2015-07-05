<?php
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

$factory->define(App\Models\User::class, function ($faker) {
  return [
    'name'           => $faker->name,
    'email'          => $faker->email,
    'password'       => str_random(10),
    'remember_token' => str_random(10),
  ];
});

$factory->define(App\Models\Navigator::class, function ($faker) {
  return [
    'name'    => $faker->bs(),
      'url'   => $faker->url(),
      'state' => 1,
      'sort'  => $faker->randomDigit()
    ];
});

$factory->define(App\Models\Slide::class, function ($faker) {
  return [
    'belongs_page' => $faker->bs()
  ];
});

$factory->define(App\Models\SlideItem::class, function ($faker) {
  return [
    'picture' => 'bujiaban.jpg',
    'url'     => 'http://yuez.me',
    'sort'    => 0
  ];
});

$factory->define(App\Models\Enterprise::class, function ($faker) {
  return [
    'name'       => $faker->company,
    'trade'      => $faker->catchPhrase,
    'is_verify'  => true,
    'is_audited' => true
  ];
});

$factory->defineAs(App\Models\Enterprise::class, 'root', function ($faker) use ($factory) {
  $enterprise = $factory->raw('App\Models\Enterprise');
  return array_merge($enterprise, ['name' => '安家传媒', 'trade' => '广告传媒']);
});

$factory->define(App\Models\User::class, function ($faker) {
  return [
    'name'      => $faker->userName,
    'email'     => $faker->email,
    'password'  => $faker->password,
    'confirmed' => true,
    'is_verify' => true
  ];
});

$factory->defineAs(App\Models\User::class, 'admin', function ($faker) use ($factory) {
  $user = $factory->raw('App\Models\User');
  return array_merge($user, ['admin' => true]);
});

$factory->defineAs(App\Models\User::class, 'root', function ($faker) use ($factory) {
  return [
    'name'      => 'root',
    'email'     => 'zgs@ypjh.wang',
    'password'  => bcrypt('public'),
    'confirmed' => true,
    'is_verify' => true,
    'admin'     => true,
  ];
});

$factory->define(App\Models\AdCategory::class, function ($faker) {
  return [
    'name' => $faker->bs
  ];
});

$factory->define(App\Models\OrderItem::class, function ($faker) {
  return [
    'from'           => Carbon::parse($faker->date($format = 'Y-m-d', $max = 'now')),
    'to'             => Carbon::parse($faker->date($format = 'Y-m-d', $max = 'now')),
    'original_price' => $faker->randomFloat(3, 0, 10000000),
    'price'          => $faker->randomFloat(3, 0, 10000000),
    'subtotal'       => $faker->randomFloat(3, 0, 10000000),
    'score'          => $faker->randomDigit,
    'quantity'       => 1
  ];
});

$factory->define(App\Models\Order::class, function ($faker) use ($factory) {
  return [
    'order_seq' => $faker->randomNumber(),
    'state'     => array_rand([0, 1, 2, 3, 4]),
    'amount'    => $faker->randomFloat(3, 0, 10000000)
  ];
});
