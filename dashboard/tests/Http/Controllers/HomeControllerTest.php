<?php

class HomeControllerTest extends TestCase
{
  public function testVisitRootPathShouldReturnHomeView()
  {
    $user = factory('App\Models\User', 'root')->create();

    $this->actingAs($user)
         ->visit('/')->see('布谷广告');
  }

  public function testShouldSeeName()
  {
    $user = factory('App\Models\User', 'root')->create();

    $this->actingAs($user)
         ->visit('/')->see($user->name);
  }
}
