<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $appends = ['name'];
    protected $fillable = ['name_en','name_ar','country_id','code'];

    public function getNameAttribute()
    {
        $lang =app()->getLocale();
        $name = "name_".$lang;
        return $this->$name;;
    }
    public function country()
    {
      return $this->belongsTo(Country::class, 'country_id');
    }
    public function cities()
    {
      return $this->hasMany('App\Models\Admin\City','state_id');
    }
}
