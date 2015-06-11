<?php
use App\Models\Navigator;

class NavigatorControllerTest extends TestCase
{
  /**
   * @before
   */
  public function setupResetDb()
  {
    Artisan::call('db:seed');
  }

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

  public function testDeleteNavigator()
  {
    Session::start();
    $navigator = Navigator::create([
      'name'  => 'hello',
      'url'   => '/hello-world',
      'sort'  => 1,
      'state' => 1
    ]);

    $this->call('DELETE', "/navigators/{$navigator->id}", ['_token' => csrf_token()]);

    $this->assertResponseOk();
    $this->assertNull(Navigator::find($navigator->id));
  }

  public function testUpdateNavigator()
  {
    Session::start();
    $navigator = Navigator::first();

    $response = $this->call('PUT', "/navigators/{$navigator->id}",
      ['_token' => csrf_token(), 'name' => 'xxoo', 'url' => $navigator->url, 'state' => 1, 'sort' => 3]);

    $this->assertResponseOk();
  }

  public function testUpdateNavigatorDumplicateNameShouldError()
  {
    Session::start();
    $nav1 = Navigator::create([
      'name'  => 'hello',
      'url'   => '/hello-world',
      'sort'  => 1,
      'state' => 1
    ]);

    $nav2 = Navigator::create([
      'name'  => 'world',
      'url'   => '/hello-world',
      'sort'  => 2,
      'state' => 1
    ]);

    $response = $this->call('PUT', "/navigators/{$nav2->id}",
      ['_token' => csrf_token(), 'name' => 'world', 'url' => $nav2->url, 'state' => 1, 'sort' => 3]);

    $this->assertResponseStatus(302);
    $nav1->delete();
    $nav2->delete();
  }

  public function testUpdateNavigatorErrorStateValue()
  {
    Session::start();
    $navigator = Navigator::create([
      'name'  => 'world',
      'url'   => '/hello-world',
      'sort'  => 2,
      'state' => 1
    ]);

    $response = $this->call('PUT', "/navigators/{$navigator->id}",
      ['_token' => csrf_token(), 'name' => 'world', 'url' => $navigator->url, 'state' => 2, 'sort' => 3]);

    $this->assertResponseStatus(302);
    $navigator->delete();
  }
}

