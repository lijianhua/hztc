<?php
use App\Reponsitories\ImageReponsitory;

class ImageReponsitoryTest extends TestCase
{
  public function testPropertiesOfClass()
  {
    $attributes = ['root', 'webRoot', 'host'];

    foreach ($attributes as $attr)
      $this->assertClassHasAttribute($attr, App\Reponsitories\ImageReponsitory::class);
  }

  public function testDefaultValueOfProperties()
  {
    $imageReponsitory = new ImageReponsitory();

    $this->assertEquals(public_path().'/upload/images',
                        $imageReponsitory->getRoot());

    $this->assertEquals('upload/images', $imageReponsitory->getWebRoot());
    $this->assertEquals('http://localhost:8000', $imageReponsitory->getHost());
  }

  public function testPath()
  {
    $image = 'wojiubujiaban.jpg';
    $imageReponsitory = new ImageReponsitory();
    $this->assertEquals('upload/images/' . $image,
      $imageReponsitory->path($image));
  }

  public function testUrl()
  {
    $image = 'wojiubujiaban.jpg';
    $imageReponsitory = new ImageReponsitory();
    $this->assertEquals('http://localhost:8000/upload/images/' . $image,
      $imageReponsitory->url($image));
  }
}
