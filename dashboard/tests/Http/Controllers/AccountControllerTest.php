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

    $this->visit('accounts/' . $user->id)->see('我的账户');
  }

  public function testCurrentUser()
  {
    $user = factory('App\Models\User', 'admin')->create();

    $this->get('accounts/' . $user->id)->see('Unauthorized');
  }
}

