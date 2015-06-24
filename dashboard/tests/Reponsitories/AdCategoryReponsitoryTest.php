<?php
use App\Reponsitories\AdCategoryReponsitory;

class AdCategoryReponsitoryTest extends TestCase
{
  public function testConvertWithRowId()
  {
    $category = factory('App\Models\AdCategory')->create();
    $repons   = new AdCategoryReponsitory($category);
    $expected = $category->toArray();
    $expected['DT_RowId'] = $category->id;

    $this->assertEquals($repons->convertToDatatableArrayWithRowId('id'), $expected);
  }
}

