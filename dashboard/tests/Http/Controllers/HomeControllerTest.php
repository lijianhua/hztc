<?php

class HomeControllerTest extends TestCase
{
  /**
   * @before
   **/
  public function setupVisit()
  {
    $this->call('GET', '/');
  }

  public function testVisitRootPath()
  {
    $this->assertResponseOk();
  }

  public function testVisitRootPathShouldReturnHomeView()
  {
    $response = $this->call('GET', '/');
    $view     = $response->original;
    $this->assertEquals('home', $view->name());
  }
}
