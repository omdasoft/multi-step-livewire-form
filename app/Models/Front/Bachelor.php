<?php

namespace App\Models\Front;

use App\Models\Front\DrProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bachelor extends Model
{
    use HasFactory;
    protected $table = 'bachelors';
    protected $fillable = [
      "dr_profile_id",
      "country_id",
      "speciality_id",
      "start_date",
      "end_date",
      "year_no",
      "average",
      "total_marks",
      "file",
      "transcripts",
    ];
    // ========== Accessories ==========

    // ========== Relationship ==========
    public function drProfile()
    {
      return $this->belongsTo(DrProfile::class, 'dr_profile_id');
    }
}
