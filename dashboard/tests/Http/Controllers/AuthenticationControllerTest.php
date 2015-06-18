<?php

class AuthenticationControllerTest extends TestCase
{
  public function testVisitShouldBeRedirectedToLoginPageWhenAsGuest()
  {
    $this->visit('/')->seePageIs('/auth/login');
  }
}

