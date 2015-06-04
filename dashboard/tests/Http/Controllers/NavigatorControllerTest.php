<?php

class NavigatorControllerTest extends TestCase
{
  public function testIndex()
  {
    $this->call('GET', '/navigators');
    $this->assertResponseOk();
  }

  public function testVisitIndexShouldRenderCorrectView()
  {
    $response = $this->call('GET', '/navigators');
    $view     = $response->original;
    $this->assertEquals('navigators.index', $view->name());
  }
}

