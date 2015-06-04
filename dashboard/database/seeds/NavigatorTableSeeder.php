<?php
use App\Models\Navigator;

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class NavigatorTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('navigators')->delete();

    $navigators = [
      '首页' => '/',
      '免费广告' => 'free',
      '特价广告' => 'sale',
      '广告众筹' => 'people'
    ];

    $sort = 0;

    foreach ($navigators as $name => $url) {
      Navigator::create([
        'name'  => $name,
        'url'   => $url,
        'state' => 1,
        'sort'  => $sort
      ]);
      $sort++;
    }
  }
}
