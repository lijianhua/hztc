<?php 

namespace App\Traits\Models;

use Config;

trait AdSpaceTransformableTrait
{
  //添加销量到elasticsearch集群索引中
  public function transform ($relations = false)
  {
    $relations = $relations ? Config::get('larasearch.paths.'.get_class($this)) : [];
    $doc = $this->load($relations)->toArray();
    $doc = $this->merge_quantity($doc);

    return $doc;
  }
  //合并quantity到索引数组中
  public function merge_quantity($doc)
  {
    return array_merge($doc,['quantity' => $this->orderItems->sum('quantity')]); 
  }
}
?>
