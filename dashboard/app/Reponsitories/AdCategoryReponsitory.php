<?php

namespace App\Reponsitories;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

use App\Models\AdCategory;

/**
 * 用来处理和广告分类相关方法
 *
 * @package App\Reponsitories
 **/
class AdCategoryReponsitory
{
  protected $category;

  public function __construct(AdCategory $category)
  {
    $this->category = $category;
  }

  public function convertToDatatableArrayWithRowId($column)
  {
    $result = $this->convertToDatatableArray();
    $result["DT_RowId"] = Arr::get($result, $column);

    return $result;
  }

  public function convertToDatatableArray()
  {
    return $this->category->toArray();
  }
} // END class AdCategoryReponsitory
