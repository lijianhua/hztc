<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\AdSpace;

class ModelEventsProvider extends ServiceProvider
{
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    // 更新时更新版本号和重置审核状态
    AdSpace::saving(function ($ad) {
      $ad->audited = false;

      if ($ad->version)
        $ad->version = $ad->version + 1;
      else
        $ad->version = 1;
    });

    // 广告位删除时，删除对应的促销活动
    AdSpace::deleted(function ($ad) {
      $ad->promotions()->delete();
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
