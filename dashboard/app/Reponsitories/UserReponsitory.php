<?php

namespace App\Reponsitories;

use App\Models\User;

/**
 * 用户帮助方法
 **/
class UserReponsitory
{
  protected $defaultImage;

  protected $imageRepons;

  public function __construct(ImageReponsitory $imageRepons)
  {
    $this->defaultImage = 'default-profile.jpg';
    $this->imageRepons  = $imageRepons;
  }

  /**
   * 获取用户头像链接
   *
   * @param \App\Models\User $user
   * @return string
   **/
  public function userImageUrl(User $user)
  {
    if (empty($user->picture)) {
      return '/images/' . $this->defaultImage;
    } else {
      return $this->imageRepons->url($user->picture);
    }
  }
}
