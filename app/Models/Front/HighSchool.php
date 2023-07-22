<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighSchool extends Model
{
    use HasFactory;
    protected $table = 'high_schools';
    protected $fillable = [
      "dr_profile_id",
      "country_id",
      "study_field",
      "year",
      "file"
    ];
    // ================== Accessories ================
    public function getFieldAttribute($value)
    {
        if ($value == 0) {
            return 'Scientific';
        }
        if ($value == 1) {
            return 'Natural Science';
        }
        if ($value == 2) {
            return 'Otherwise';
        }
    }
    // ================== Relationship ==================
    public function drProfile()
    {
      return $this->belongsTo(DrProfile::class, 'dr_profile_id');
    }
}
