<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  use HasFactory;
  protected $appends = ['name'];
  protected $fillable = ['name_en', 'name_ar', 'country_code', 'iso_code', 'is_arab', 'required_internship'];

  // =========================================== Accesories ==================================================
  public function getNameAttribute()
  {
      $lang =app()->getLocale();
      $name = "name_".$lang;
      return $this->$name;;
  }
  // =========================================== Relationship Section ==================================================
  public function states()
  {
    return $this->hasMany('App\Models\Admin\State', 'country_id');
  }
  public function cities()
  {
    return $this->hasMany('App\Models\Admin\City', 'country_id');
  }
  public function universities()
  {
    return $this->hasMany('App\Models\Admin\University','country_id');
  }

  public static function getAll()
  {
    return cache()->rememberForever('countries.all', function () {
      return self::orderBy('name_en')->get();
    });
  }
}
