<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrProfile extends Model
{
    use HasFactory;    
    //protected $appends = ['name'];// if we have column not found in real filed in database , we use this to override existing field 
    protected $table = 'dr_profiles';
    protected $fillable = [ // use this array to insure the securtty to prevent insert any not existing fields
      "user_id",
      "name_ar",
      "name_en",
      "gender",
      "bairthdate",
      "nationality_id",
      "birthplace",
      "phone",
      "phone_country_code",
      "passport_no",
      "country_id",
      "state_id",
      "city_id",
      "address",
      "personal_image",
      "passport_copy",
    ];
    // ============= Accessories ==============

    // ============= Relationship =============
    // one to one
    public function user() // Camele Case and based on class 
    {
       return $this->belongsTo(User::class, 'user_id');// we can write without 'user_id'
    }
    public function highSchool()
    {
        return $this->hasOne(HighSchool::class,'dr_profile_id');
    }
    public function bachelor()
    {
        return $this->hasOne(Bachelor::class,'dr_profile_id');
    }
    public function internship()
    {
        return $this->hasMany(Internship::class,'dr_profile_id');
    }
    public function residencyProgramType()
    {
        return $this->hasOne(ResidencyProgramType::class,'dr_profile_id');
    }
    public function board()
    {
        return $this->hasMany(Board::class,'dr_profile_id');
    }

    const TABS = [
        'profile' => 'Personal Information',
        'high-school' => 'High School',
        //'higher-education' => 'Higher Education',
    ];
}
