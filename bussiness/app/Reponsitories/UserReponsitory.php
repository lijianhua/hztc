<?php

namespace App\Reponsitories;

use HTML;
use Datatables;

use App\Models\User;

/**
 * 用户帮助方法
 **/
class UserReponsitory
{
  protected $defaultImage;

  public function __construct()
  {
    $this->defaultImage = 'default-profile.jpg';
  }

  /**
   * 获取用户头像链接
   *
   * @param \App\Models\User $user
   * @return string
   **/
  public function userImageUrl(User $user)
  {
    if (empty($user->avatar_file_name)) {
      return '/images/' . $this->defaultImage;
    } else {
      return $user->avatar->url('thumb');
    }
  }

  public function datatables($query)
  {
    return Datatables::of($query)
      ->editColumn('is_verify', function ($user) {
        return " <span class=\"label label-warning\">等待认证</span>";
      })
      ->make(true);
  }
}
