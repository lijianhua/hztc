<?php

namespace App\Reponsitories;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;

use App\Models\AdCategory;
use App\Transformers\AdCategoryTransformer;

/**
 * 用来处理和广告分类相关方法
 *
 * @package App\Reponsitories
 **/
class AdCategoryReponsitory
{
  /**
   * 模型的值
   *
   * @var AdCategory
   **/
  protected $category;

  public function __construct(AdCategory $category)
  {
    $this->category = $category;
  }

  /**
   * 将模型转成需要 datatables 需要的数据类型，添加 row id
   * @var string $column
   **/
  public function convertToDatatableArrayWithRowId($column)
  {
    $result = $this->convertToDatatableArray();
    $result["DT_RowId"] = Arr::get($result, $column);

    return $result;
  }

  /**
   * 将模型转成需要 datatables 需要的数据类型
   **/
  public function convertToDatatableArray()
  {
    $fractal  = new Manager();
    $fractal->setSerializer(new ArraySerializer());

    if (!is_null($this->category->parent_id)) {
      $fractal->parseIncludes('parent');
    }

    $resource = new Item($this->category, new AdCategoryTransformer());
    return $fractal->createData($resource)->toArray();
  }

  /**
   * 获取广告的分类信息
   *
   * @var AdSpace $ad
   * @var AdCategory $category
   * @return string
   **/
  public static function categoriesStrForAd($ad, $category)
  {
    $categories = $ad->categories()->whereParentId($category->id)->get();

    if ($categories->count() == $category->children()->count()) {
      return '全部';
    } else {
      return implode(", ", $categories->lists('name')->toArray());
    }
  }
}
