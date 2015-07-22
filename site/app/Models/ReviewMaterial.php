<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
class ReviewMaterial extends Model implements StaplerableInterface {

  use EloquentTrait;
  //
  protected $fillable = ['enterprise_id', 'name', 'note', 'avatar', 'is_text', 'is_image'];

  public function __construct(array $attributes = array()) 
  {
          $this->hasAttachedFile('avatar', [
                        'styles' => [
                                 'medium' => '300x300',
                                 'thumb' => '100x100',
                                 'cover'  => '280x160'
                                 ]
                                                                            ]);
     parent::__construct($attributes);
  }
}
