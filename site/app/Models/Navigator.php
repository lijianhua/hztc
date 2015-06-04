<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigator extends Model {
  protected $guarded = ['id'];

  protected $casts = [
    'state' => 'boolean'
  ];
}
