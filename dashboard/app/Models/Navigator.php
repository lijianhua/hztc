<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigator extends Model {
  protected $guarded = ['id'];

  protected $casts = [
    'state' => 'boolean'
  ];

  public function getClassOfStateLabelAttribute()
  {
    return $this->state ? "success" : "error";
  }

  public function getTextOfStateLabelAttribute()
  {
    return $this->state ? "已启动" : "已停用";
  }
}
