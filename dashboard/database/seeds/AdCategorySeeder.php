<?php

use Illuminate\Database\Seeder;
use App\Models\AdCategory;

class AdCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $categories = [
      '媒体类型' => [
        '热门活动', '新媒体(微信、微博、其他)', 'APP',
        '网络(网站、软件)', '电视', '广播', '户外', '室内', '其他'
      ],

      '媒体风格' => [
        '社会', '娱乐', '科技', '体育', '时尚', '财经', '学术',
        '生活', '法制', '健康'
      ],

      '财富圈'   => [
        '普通', '精英', '财富'
      ],

      '年龄圈'   => [
        '儿童', '青少年', '中年', '老年'
      ],

      '针对性别' => [
        '男', '女'
      ],

      '社会圈'   => [
        '地产圈', 'IT圈', '金融圈', '汽车圈', '科技圈',
        '养生圈', '购物圈', '吃货圈', '八卦圈', '上班族',
        '老板圈', '游戏圈'
      ]
    ];

    foreach ($categories as $root => $children) {
      $root = AdCategory::create(['name' => $root]);

      foreach ($children as $child) {
        $root->children()->create(['name' => $child]);
      }
    }
  }
}
