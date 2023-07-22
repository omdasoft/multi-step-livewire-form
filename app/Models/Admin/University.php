<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $appends = ['name'];
    protected $table = 'universities';
    protected $fillable = [
        "name_ar",
        "name_en",
        "country_id",
        "status",
    ];
    // =========================================== Accessories ===========================================================
    public function getNameAttribute()
    {
        $lang =app()->getLocale();
        $name = "name_".$lang;
        return $this->$name;;
    }
    public function getStatusAttribute($value)
    {
        if ($value == 0) {
            return 'Active';
        } elseif ($value == 1) {
            return 'Inactive';
        }
    }
    
    // =========================================== Relationship Section ==================================================
    public function universitiesCountry()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    
    public function bscUniversity()
    {
        return $this->hasMany(BscInfo::class, 'university_id');
    }

    public function universityMaster()
    {
      return $this->hasMany(Master::class, 'university_id');
    }
}

