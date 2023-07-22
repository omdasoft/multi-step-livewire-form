<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $appends = ['name'];
    protected $fillable = ['name_en', 'name_ar', 'country_id', 'state_id'];

    public function getNameAttribute()
    {
        $lang = app()->getLocale();
        $name = "name_" . $lang;
        return $this->$name;;
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    // Relation With DoctorPersonalInfo Model
    public function doctorCityResidency()
    {
        return $this->hasMany(DoctorPersonalInfo::class, 'residency_city_id');
    }
    public function doctorJobCity()
    {
        return $this->hasMany(DoctorPersonalInfo::class, 'job_city_id');
    }

    public static function getAll()
    {
        return cache()->rememberForever('cities.all', function () {
            return self::orderBy('name_en')->limit(1000)->get();
        });
    }
}
