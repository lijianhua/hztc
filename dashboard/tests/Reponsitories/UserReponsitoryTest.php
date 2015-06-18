<?php

use App\Reponsitories\UserReponsitory;

class UserReponsitoryTest extends TestCase
{
  public function testUserImageUrl()
  {
    $user = factory('App\Models\User')->create();
    $repons = new UserReponsitory();

    $this->assertEquals('/images/default-profile.jpg', $repons->userImageUrl($user));
  }
}

