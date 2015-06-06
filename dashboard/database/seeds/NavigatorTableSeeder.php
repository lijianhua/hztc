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
      '全部广告' => 'ad-spaces',
      '免费专区' => 'free-ads',
      '特价风暴' => 'discounted-ads',
      '媒体众筹' => 'agency-crowd-funding',
      '客户众筹' => 'advertiser-crowd-funding'
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
