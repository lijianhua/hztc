<?php

use Illuminate\Database\Seeder;

use App\Models\Slide;

class SlideTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('slides')->delete();

    $slide = Slide::create([
      'belongs_page' => '首页'
    ]);

    $slideItem = factory('App\Models\SlideItem')->make();
    $slide->slideItems()->save($slideItem);
  }
}
