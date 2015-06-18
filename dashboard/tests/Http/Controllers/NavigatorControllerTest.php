<?php
use App\Models\Navigator;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class NavigatorControllerTest extends TestCase
{
  use WithoutMiddleware;

  public function setUp()
  {
    parent::setUp();
    factory('App\Models\Navigator')->create();
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
    $response = $this->put("/navigators/{$navigator->id}",
      [
        'name'   => 'xxoo',
        'url'    => '/hello',
        'state'  => 1,
        'sort'   => 3,
        '_token' => csrf_token()
      ]);

    $this->assertResponseOk();

    $response->seeJson([
      'state'   => 'OK',
      'message' => '更新成功',
    ]);
  }

  public function testUpdateNavigatorDumplicateNameShouldError()
  {
    Session::start();
    $nav1 = factory('App\Models\Navigator')->create();
    $nav2 = factory('App\Models\Navigator')->create();

    $response = $this->call('PUT', "/navigators/{$nav2->id}",
      ['_token' => csrf_token(), 'name' => $nav1->name, 'url' => $nav2->url, 'state' => 1, 'sort' => 3]);

    $this->assertResponseOk();
  }

  public function testUpdateNavigatorErrorStateValue()
  {
    Session::start();
    $navigator = factory('App\Models\Navigator')->create();

    $response = $this->call('PUT', "/navigators/{$navigator->id}",
      ['_token' => csrf_token(), 'name' => 'world', 'url' => $navigator->url, 'state' => 2, 'sort' => 3]);

    $this->assertResponseStatus(302);
  }

  public function testCreateNewNavigator()
  {
    Session::start();

    $navigator = factory('App\Models\Navigator')->make();
    $this->post('/navigators', [
        '_token' => csrf_token(),
        'name'   => $navigator->name,
        'url'    => $navigator->url,
        'state'  => $navigator->state,
        'sort'   => $navigator->sort
      ])->seeJson([
        'state' => 'OK'
      ]);
  }

  public function testCreateDumplicateNameNavigator()
  {
    Session::start();

    $navigator = factory('App\Models\Navigator')->create();
    $this->post('/navigators', [
        '_token' => csrf_token(),
        'name'   => $navigator->name,
        'url'    => $navigator->url,
        'state'  => $navigator->state,
        'sort'   => $navigator->sort
      ]);
    $this->assertResponseStatus(302);
  }
}
