<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdSpaceUser extends Model {


  public function adSpaces()
  {
    return $this->hasOne('App\Models\AdSpace', 'id', 'ad_space_id');
  }

}
