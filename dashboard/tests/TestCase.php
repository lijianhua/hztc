<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
  use DatabaseMigrations;

  /**
   * The base URL to use while testing the application.
   *
   * @var string
   */
  protected $baseUrl = 'http://localhost';

  /**
   * Creates the application.
   *
   * @return \Illuminate\Foundation\Application
   */
  public function createApplication()
  {
    putenv('DB_CONNECTION=sqlite_testing');

    $app = require __DIR__.'/../bootstrap/app.php';

    $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

    return $app;
  }

  public function setUp()
  {
    parent::setUp();
    Artisan::call('migrate');
    Session::start();
  }

  public function tearDown()
  {
    Artisan::call('migrate:reset');
    parent::tearDown();
  }

  public function createRoot()
  {
    $e = factory('App\Models\Enterprise', 'root')->create();
    $u = factory('App\Models\User', 'root')->create();
    $u->enterprise_id = $e->id;
    $u->save();
    return $u;
  }
}
