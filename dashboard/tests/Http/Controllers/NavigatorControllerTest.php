<?php
use App\Models\Navigator;

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
    $this->assertViewHas('navigators');
  }

  public function testToggleNavigatorState()
  {
    // 初始化
    Session::start();
    $navigator = Navigator::first();
    $navigator->state = true;
    $navigator->save();

    $this->call('PUT', "/navigators/{$navigator->id}/toggle", ['_token' => csrf_token()]);
    $this->assertResponseOk();

    $navigator = Navigator::first();
    $this->assertEquals(false, $navigator->state);
  }
}

