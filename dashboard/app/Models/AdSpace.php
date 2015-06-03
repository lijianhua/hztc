<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdSpace extends Model {

  Use SoftDeletes;

  protected $dates = ['deleted_at'];
}
