<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Enterprise extends Model implements StaplerableInterface {

  use EloquentTrait;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'trade', 'weixin', 'qq',
    'telphone', 'phone', 'avatar'];

  protected $casts = [
    'is_audited' => 'boolean'
  ];

  public function __construct(array $attributes = array()) {
    $this->hasAttachedFile('avatar', [
      'styles' => [
        'medium' => '300x300',
        'thumb' => '150x150'
      ]
    ]);

    parent::__construct($attributes);
  }

  public function users()
  {
    return $this->hasMany('App\Models\User');
  }

  public function reviewMaterials()
  {
    return $this->hasMany('App\Models\ReviewMaterial');
  }

  public function adCenters()
  {
    return $this->belongsToMany('App\Models\AdCenters', 'ad_center_enterprise');
  }

  public function scopePending($query)
  {
    return $query->whereIsVerify(0);
  }

  public function scopeRecent($query)
  {
    return $query->orderBy('created_at', 'desc');
  }
}
