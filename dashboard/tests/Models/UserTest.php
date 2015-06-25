<?php

class UserTest extends TestCase
{
  public function testBelongsToEnterprise()
  {
    $enterprise = factory('App\Models\Enterprise', 'root')->create();
    $root = factory('App\Models\User', 'root')->create();

    $root->enterprise_id = $enterprise->id;
    $root->save();

    $this->assertEquals($root->enterprise->id, 1);
  }

}

