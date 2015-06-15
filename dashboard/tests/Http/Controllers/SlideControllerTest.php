<?php
use App\Models\Slide;

class SlideControllerTest extends TestCase
{
  public function testIndex()
  {
    $this->visit('/slides')->see('轮播图');
  }

  public function testDelete()
  {
    $slide = factory('App\Models\Slide')->create();
    $this->delete("/slides/{$slide->id}", ['_token' => csrf_token()]);
    $this->assertResponseOk();
  }

  public function testUpdate()
  {
    $slide = factory('App\Models\Slide')->create();
    $this->put("/slides/{$slide->id}", [
      '_token' => csrf_token(),
      'belongs_page'   => '星空'
    ]);
    $slide = Slide::find($slide->id);
    $this->assertResponseOk();
    $this->assertEquals('星空', $slide->belongs_page);
  }
}
