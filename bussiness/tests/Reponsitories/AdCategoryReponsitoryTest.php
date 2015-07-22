<?php
use App\Reponsitories\AdCategoryReponsitory;

class AdCategoryReponsitoryTest extends TestCase
{
  public function testConvertWithRowId()
  {
    $category = factory('App\Models\AdCategory')->create();
    $root     = factory('App\Models\AdCategory')->create();
    $category->parent_id = $root->id;
    $category->save();

    $repons   = new AdCategoryReponsitory($category);
    $data     = $repons->convertToDatatableArrayWithRowId('id');

    $this->assertEquals($category->id, $data['DT_RowId']);
    $this->assertEquals($category->parent_id, $data['parent']['id']);
  }
}

