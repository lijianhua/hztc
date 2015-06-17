<?php

namespace App\Reponsitories;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * 处理图片上传、保存、缩略图等行为
 *
 * @package App\Reponsitories
 **/
class ImageReponsitory
{
  /**
   * 主机服务器
   *
   * @var string
   **/
  protected $host;

  /**
   * 储存图片根目录
   *
   * @var string
   **/
  protected $root;

  /**
   * 图片的 web 根目录
   *
   * @var string
   **/
  protected $webRoot;

  public function __construct()
  {
    $this->host    = env('IMAGE_HOST', 'http://localhost:8000');
    $this->webRoot = env('IMAGE_WEB_PATH', 'upload/images/');
    $this->root    = env('IMAGE_ROOT_PATH', public_path() . '/' . $this->webRoot);
  }

  /**
   * 生成 image 访问的相对路径
   *
   * @param string $image
   * @return string
   **/
  public function path($image)
  {
    return $this->buildPath([$this->webRoot, $image]);
  }

  /**
   * 生成访问图片的链接
   *
   * @param string $image
   * @return string
   **/
  public function url($image)
  {
    return $this->trimUrl($this->host, $this->path($image));
  }

  /**
   * 保存上传的图片
   *
   * @param mixed $file
   * @return mixed
   **/
  public function save(UploadedFile $file)
  {
    $filename = $this->generateRandomString(64);
    return $file->move($this->getRoot(), $filename);
  }

  /**
   * 生成 html 图片标签
   *
   * @param strig $image
   * @param array $attributes
   * @return string
   **/
  public function tag($image, $attributes = [])
  {
    $img = "<img src=\"{$this->url($image)}\"";
    foreach ($attributes as $key => $value)
      $img .= " {$key}=\"{$value}\"";
    $img .= ">";
    return $img;
  }

  /**
   * 获取 host
   *
   * @return string
   **/
  public function getHost()
  {
    return $this->host;
  }

  /**
   * 获得图片根目录
   *
   * @return string
   **/
  public function getRoot()
  {
    return $this->root;
  }

  /**
   * 获得 web 根目录
   *
   * @return string
   **/
  public function getWebRoot()
  {
    return $this->webRoot;
  }

  /**
   * 生成一个访问图片的 path
   */
  protected function buildPath($extra = [])
  {
    $path = implode('/', array_map(
      'rawurlencode', (array) $extra
    ));
    return rawurldecode($path);
  }

  /**
   * 将多个 url 组成部分合并为一个 url
   *
   * @param  string  $root
   * @param  string  $path
   * @param  string  $tail
   * @return string
   */
  protected function trimUrl($root, $path, $tail = '')
  {
    return trim($root.'/'.trim($path.'/'.$tail, '/'), '/');
  }

  /**
   * 获取随机字符串作为图片名称
   *
   * @param integer $length
   * @return string
   **/
  protected function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
} // END class ImageReponsitory
