<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model {

  /**
   *
   */
  public function adSpacesCart()
  {
    return $this->hasOne('App\Models\AdSpace', 'id', 'ad_space_id');
  }

}
