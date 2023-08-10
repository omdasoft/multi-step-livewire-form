<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Country;

class Internship extends Model
{
    use HasFactory;    
    protected $table = 'internships';
    protected $fillable = [
      "dr_profile_id",
      "internship_certified",
      "internship_training",
      "country_id",
      "hospital_name",
      "sector",
      "duration",
      "start_date",
      "end_date",
      "termination_doc",
      "certificate",
      "syndicate_doc",
    ];
    // =========== Accessories ===========

    // =========== Relationship ==========
    public function drProfile()
    {
      return $this->belongsTo(DrProfile::class, 'dr_profile_id');
    }

    public function country()
    {
      return $this->belongsTo(Country::class);
    }

    public function getIsCertifiedInternshipAttribute()
    {
      return $this->attributes['internship_certified'] == 1 ? 'Yes':'no';
    }
}
