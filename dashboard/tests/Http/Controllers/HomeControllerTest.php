<?php

class HomeControllerTest extends TestCase
{
  public function testVisitRootPathShouldReturnHomeView()
  {
    $this->visit('/')->see('布谷广告');
  }
}
