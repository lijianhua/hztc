<?php
use App\Models\Slide;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SlideControllerTest extends TestCase
{
  use WithoutMiddleware;

  public function testIndex()
  {
    $this->visit('/slides')->see('轮播图');
  }

  public function testHasAttributeImageReponsitory()
  {
    $this->assertClassHasAttribute('imageRepons', App\Http\Controllers\SlideController::class);
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

  public function testUpdateShoudBeInterruptWhenPassIncorrectValue()
  {
    $slide = factory('App\Models\Slide')->create();
    $this->put("/slides/{$slide->id}", [
      '_token' => csrf_token(),
      'belongs_page' => ''
    ]);
    $this->assertResponseStatus(302);
  }

  public function testUpdateShouldBeInterruptWhenPassDumplicateValue()
  {
    $slide1 = factory('App\Models\Slide')->create();
    $slide2 = factory('App\Models\Slide')->create();
    $this->put("/slides/{$slide1->id}", [
      '_token' => csrf_token(),
      'belongs_page' => $slide2->belongs_page
    ]);

    $this->assertResponseStatus(302);
  }

  public function testCreate()
  {
    $this->post("/slides", [
      '_token' => csrf_token(),
      'belongs_page' => '星空'
    ]);
    $this->assertResponseOk();
  }

  public function testDetail()
  {
    $slide = factory('App\Models\Slide')->create();

    $this->get("/slides/{$slide->id}")
         ->see("{$slide->belongs_page}轮播图");
  }
}
