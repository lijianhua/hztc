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
}

