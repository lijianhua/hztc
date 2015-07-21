<?php

namespace App\Providers;

use HTML;
use Blade;
use App\Reponsitories\OrderReponsitory;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    Blade::directive('orderStateLabel', function ($state) {
      return <<< EOF
        <?php echo HTML::decode(new OrderReponsitory()->orderStateLabel(with($state))) ?>
EOF;
    });
  }

  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
