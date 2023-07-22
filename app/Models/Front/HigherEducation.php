<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HigherEducation extends Model
{
    use HasFactory;
    protected $table = 'residency_program_types';
    protected $fillable = [
        "residency_program_type_id",
        "type",
        "speciality_id",
        "country_id",
        "university_name",
        "years_number",
        "start_date",
        "end_date",
        "certificate_scan",
        "training_scan",
    ];
    // ================== Accessories ================

    // ================== Relationship ==================
    public function residencyProgramType()
    {
      return $this->belongsTo(ResidencyProgramType::class, 'residency_program_type_id');
    }
}
