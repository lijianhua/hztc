<?php

use App\Reponsitories\UserReponsitory;
use App\Reponsitories\ImageReponsitory;

class UserReponsitoryTest extends TestCase
{
  public function testUserImageUrl()
  {
    $user = factory('App\Models\User')->create();
    $repons = new UserReponsitory(new ImageReponsitory());

    $this->assertEquals('/images/default-profile.jpg', $repons->userImageUrl($user));
  }
}

