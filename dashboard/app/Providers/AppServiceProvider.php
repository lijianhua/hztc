<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    $imageRepons = new \App\Reponsitories\ImageReponsitory();
    view()->share('userRepons', new \App\Reponsitories\UserReponsitory($imageRepons));

  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->registerLocal();
  }

  public function registerLocal()
  {
    if ($this->app->environment() == 'local') {
      $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
      $this->app->register('Barryvdh\Debugbar\ServiceProvider');
    }
  }
}
