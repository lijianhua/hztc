<?php

namespace spec\App\Http\Controllers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HomeControllerSpec extends ObjectBehavior
{
  function it_is_initializable()
  {
    $this->shouldHaveType('App\Http\Controllers\HomeController');
  }
}
