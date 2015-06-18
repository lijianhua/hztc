<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;

class HomeControllerTest extends TestCase
{
  use WithoutMiddleware;

  public function testVisitRootPathShouldReturnHomeView()
  {
    $this->visit('/')->see('布谷广告');
  }
}
