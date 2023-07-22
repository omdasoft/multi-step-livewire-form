<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidancuProgram extends Model
{
    use HasFactory;
    protected $table = 'residency_programs';
    protected $fillable = [
        "residency_program_type_id",
        "speciality_id",
        "country_id",
        "sector_id",
        "hospital_name",
        "years_number",
        "start_date",
        "end_date",
        "residency_level",
        "first_year_scan",
        "completion_scan",
    ];
    // ================== Accessories ================

    // ================== Relationship ==================
    public function residencyProgramType()
    {
      return $this->belongsTo(ResidencyProgramType::class, 'residency_program_type_id');
    }
}