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
      '全部广告位' => 'ads',
      '免费广告位' => 'free-ads',
      '特价广告位' => 'special-offers',
      '创意类广告' => 'creative-ads'
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
