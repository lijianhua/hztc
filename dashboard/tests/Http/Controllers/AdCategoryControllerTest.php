<?php

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
}

