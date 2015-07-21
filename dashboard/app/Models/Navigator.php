<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigator extends Model {
  protected $guarded = ['id'];

  protected $casts = [
    'state' => 'boolean'
  ];

  public function getClassOfStateLabelAttribute()
  {
    return $this->state ? "success" : "danger";
  }

  public function getTextOfStateLabelAttribute()
  {
    return $this->state ? "已启用" : "已停用";
  }
}
