<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, StaplerableInterface {

  use Authenticatable, CanResetPassword, EloquentTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'email', 'password', 'avatar'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];

  protected $casts = [
    'admin'     => 'boolean',
    'confirmed' => 'boolean'
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

  public function enterprise()
  {
    return $this->belongsTo('App\Models\Enterprise');
  }

  public function userInformations()
  {
    return $this->hasMany('App\Models\UserInformation');
  }

  public function adSpaces()
  {
    return $this->hasMany('App\Models\AdSpace')->withTrashed();
  }

  public function orders()
  {
    return $this->hasMany('App\Models\Order')->withTrashed();
  }

  public function scopePending($query)
  {
    return $query->whereIsVerify(0);
  }

  public function scopeAdmin($query)
  {
    return $query->whereAdmin(true);
  }

  public function scopeLeftJoinEnterprise($query)
  {
    return $query->leftJoin('enterprises', 'enterprises.id', '=', 'users.enterprise_id');
  }
}
