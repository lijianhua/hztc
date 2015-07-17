<?php namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Iverberk\Larasearch\Traits\SearchableTrait;

class AdSpace extends Model implements StaplerableInterface {

  Use SoftDeletes, EloquentTrait, SearchableTrait;

  public static $__es_config = [
    'autocomplete' => ['title'],
    'suggest'      => ['title'],
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'avatar', 'description', 'street_address',
    'detail', 'type', 'sort'
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

  /**
    * @return \Illuminate\Database\Eloquent\Relations
    **/
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
  public function orderItems()
  {
    return $this->hasMany('App\Models\OrderItem');
  }

  /**
   *
   */
  public function adSpaceUsers()
  {
    return $this->hasMany('App\Models\AdSpaceUser');
  }

  /**
   *
   */
  public function customerReviews()
  {
    return $this->hasMany('App\Models\CustomerReview');
  }
  public static function get_ideas_adspaces($type_nu, $sort)
  {
    $sort_array = ['price'=> 'ad_prices.price', 'quantity' => 'order_items.quantity', 'date' => 'ad_spaces.created_at', 'id' => 'ad_spaces.id'];
    $adspaces = '';
    if($type_nu == '')
    {
      foreach ($sort_array as $index => $value)
      {
        if($index == $sort)
        {
          $adspaces   = AdSpace::with(['images', 'orderItems', 'adSpaceUsers'])
                      ->leftJoin('ad_prices', 'ad_spaces.id', '=', 'ad_prices.ad_space_id')
                      ->leftjoin('order_items', 'ad_spaces.id', '=', 'order_items.ad_space_id')
                      ->leftjoin('ad_space_users', 'ad_spaces.id', '=', 'ad_space_users.ad_space_id')
                      ->groupBy('ad_spaces.id')
                      ->select("*", DB::raw('min(ad_prices.price) as price'))
                      ->where('ad_spaces.audited', '=', 1)
                      ->orderBy($value, 'desc')
                      ->paginate(6);
        }
      }
    }
    else
    {
      foreach ($sort_array as $index => $value)
      {
        if($index == $sort)
        {
          $adspaces   = AdSpace::with(['images', 'orderItems', 'adSpaceUsers'])
                      ->leftJoin('ad_prices', 'ad_spaces.id', '=', 'ad_prices.ad_space_id')
                      ->leftjoin('order_items', 'ad_spaces.id', '=', 'order_items.ad_space_id')
                      ->leftjoin('ad_space_users', 'ad_spaces.id', '=', 'ad_space_users.ad_space_id')
                      ->where('ad_spaces.type', '=', $type_nu)
                      ->groupBy('ad_spaces.id')
                      ->select("*", DB::raw('min(ad_prices.price) as price'))
                      ->where('ad_spaces.audited', '=', 1)
                      ->orderBy($value, 'desc')
                      ->paginate(6);
        }
      }
    }
    $ideas = AdSpace::leftjoin('ad_prices', 'ad_spaces.id', '=', 'ad_prices.ad_space_id')
           ->leftjoin('order_items', 'ad_spaces.id', '=', 'order_items.ad_space_id')
           ->leftjoin('ad_space_users', 'ad_spaces.id', '=', 'ad_space_users.ad_space_id')
           ->where('ad_spaces.audited', '=', '1')
           ->where('ad_spaces.type', '=', '3')
           ->orderBy('ad_prices.price', 'desc')
           ->orderBy('order_items.quantity', 'desc')
           ->groupBy('ad_spaces.id')
           ->get();
    return ['adspaces' => $adspaces,'ideas' => $ideas];
  }
}
