<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
class AppServiceProvider extends ServiceProvider {

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
    Validator::extend('phonecode', function($attribute, $value, $parameters)
    {
      return \App\Models\ValiCodeRepository::auth($value);
    });

    /**
    * 验证是否为手机号码
    **/
    Validator::extend('tel', function($attribute, $value, $parameters)
    {
      return preg_match('/\d{11}/', $value);
    });
  }

  /**
   * Register any application services.
   *
   * This service provider is a great spot to register your various container
   * bindings with the application. As you can see, we are registering our
   * "Registrar" implementation here. You can add your own bindings too!
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind(
      'Illuminate\Contracts\Auth\Registrar',
      'App\Services\Registrar'
    );

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
