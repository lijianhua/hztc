<?php
use App\Models\AdCategory;

class AdCategoryControllerTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();

    $user = factory('App\Models\User', 'root')->create();
    $this->actingAs($user);
  }

  public function testIndex()
  {
    $this->visit('ad-categories');
    $this->assertResponseOk();
  }

  public function testDelete()
  {
    $category = factory('App\Models\AdCategory')->create();

    $this->delete('/ad-categories/' . $category->id, ['_token' => csrf_token()])
         ->assertResponseOk();
  }

  public function testRoots()
  {
    $category = factory('App\Models\AdCategory')->create();
    $this->get('ad-categories/roots');
    $this->assertResponseOk();
  }

  public function testUpdate()
  {
    $category = factory('App\Models\AdCategory')->create();

    $this->put('ad-categories/' . $category->id, [
      '_token' => csrf_token(),
      'parent_id' => $category->parent_id,
      'name'      => '星空'
    ]);

    $this->assertResponseOk();
  }

  public function testCreate()
  {
    $oldCount = AdCategory::count();

    $this->post('ad-categories', [
      '_token' => csrf_token(),
      'name'      => '星空'
    ]);

    $this->assertResponseOk();
    $this->assertEquals(AdCategory::count() - $oldCount, 1);
  }

  public function testDumplicateCreate()
  {
    $category = factory('App\Models\AdCategory')->create();

    $this->post('ad-categories', [
      '_token' => csrf_token(),
      'name'      => $category->name
    ]);

    $this->assertResponseStatus(302);
  }
}

