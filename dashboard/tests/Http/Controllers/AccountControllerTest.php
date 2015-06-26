<?php
use Illuminate\Support\Facades\Auth;

class AccountControllerTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();

    $user = $this->createRoot();
    $this->actingAs($user);
  }

  public function testIndex()
  {
    $user = Auth::user();

    $this->visit('accounts' . $user->id)->see('我的账户');
  }
}

