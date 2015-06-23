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

    $this->delete('/ad-categories/' . $category->id)->assertResponseOk();
  }
}

