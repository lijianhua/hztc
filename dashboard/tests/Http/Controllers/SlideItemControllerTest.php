<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SlideItemControllerTest extends TestCase
{
  use WithoutMiddleware;

  public function testDeleteSlideItem()
  {
    $slide = factory('App\Models\Slide')->create();
    $slideItem = $slide->slideItems()->save(factory('App\Models\SlideItem')->make());

    $this->delete("slides/{$slide->id}/slide-items/{$slideItem->id}", [
      '_token' => csrf_token()
    ]);
    $this->assertResponseOk();
  }
}

