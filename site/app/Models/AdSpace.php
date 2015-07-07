<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdSpace extends Model {

  Use SoftDeletes;

  protected $dates = ['deleted_at'];

  public function __construct(array $attributes = array()) {
    $this->hasAttachedFile('avatar', [
      'styles' => [
        'medium' => '300x300',
        'thumb'  => '150x150',
        'cover'  => '280x160'
      ]
    ]);

    parent::__construct($attributes);
  }

  public function scopeWaitingForAudited($query)
  {
    return $query->whereAudited(false);
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function categories()
  {
    return $this->belongsToMany('App\Models\AdCategory', 'ad_category_ad_space');
  }

  /**
   * @follow NEVER
   **/
  public function images()
  {
    return $this->belongsToMany('App\Models\Image', 'ad_space_image', 'ad_space_id', 'image_id');
  }

  /**
    * @return \Illuminate\Database\Eloquent\Relations
    **/
  public function adPrices()
  {
    return $this->hasMany('App\Models\AdPrice');
  }

  /**
    * @return \Illuminate\Database\Eloquent\Relations
    **/
  public function address()
  {
    return $this->belongsTo('App\Models\Address');
  }

  /**
   * @follow NEVER
   **/
  public function orders()
  {
    return $this->hasOne('App\Models\AdPrice');
  }
}
