<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class AdSpace extends Model implements StaplerableInterface {

  Use SoftDeletes, EloquentTrait;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'avatar', 'description', 'street_address',
    'detail', 'type', 'sort', 'influence'
  ];

  /**
   * The attributes that are casts
   *
   * @var array
   */
  protected $casts = [
    'audited' => 'boolean'
  ];

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

  public function images()
  {
    return $this->belongsToMany('App\Models\Image', 'ad_space_image', 'ad_space_id', 'image_id');
  }

  public function adPrices()
  {
    return $this->hasMany('App\Models\AdPrice');
  }

  public function address()
  {
    return $this->belongsTo('App\Models\Address');
  }

  public function orders()
  {
    return $this->hasMany('App\Models\Order')->withTrashed();
  }

  public function promotions()
  {
    return $this->hasMany('App\Models\Promotion');
  }
}
