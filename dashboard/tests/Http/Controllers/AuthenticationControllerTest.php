<?php

class AuthenticationControllerTest extends TestCase
{
  public function testVisitShouldBeRedirectedToLoginPageWhenAsGuest()
  {
    $this->visit('/')->seePageIs('/auth/login');
  }

  public function testLogin()
  {
    $user = factory('App\Models\User', 'root')->create();
    $this->actingAs($user)
         ->visit('/')->seePageIs('/');
  }

  public function testVisitShouldBeRedirectedToLoginPageWhenAsNotAdminUser()
  {
    $user = factory('App\Models\User')->create();
    $this->actingAs($user)
         ->visit('/')->seePageIs('/auth/login');
  }

  public function testVisitLoginPageShouldBeRedirectedToHomeWhenIsLogin()
  {
    $user = factory('App\Models\User', 'root')->create();
    $this->actingAs($user)
         ->visit('/auth/login')->seePageIs('/');
  }
}

